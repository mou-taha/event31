<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Menu;
use App\Models\Type;
use App\Models\Virtual;
use App\Models\Physical;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all();
        $types = Type::all();
        $menus = Menu::all();
    
        $selectedCity = $request->input('city');
        $selectedDate = $request->input('date');
        $selectedTypes = $request->input('type', []);
        $selectedPrices = $request->input('price', []);
        $sortBy = $request->input('sort', 'ds');
        $searchTerm = $request->input('search');
        $selectedTypeId = $request->input('type_id');
        $selectedSubtypeId = $request->input('subtype_id');
        //$page = $request->get('page', 1);
       $items = $this->loadItems($request,$selectedCity, $selectedDate, $selectedTypes, $selectedPrices, $sortBy, $searchTerm, $selectedTypeId, $selectedSubtypeId);
       if ($request->ajax()) {
                // If it's an AJAX request, return only the new posts (e.g., as JSON)
                 
                return response()->json(view('partials.event', compact('items'))->render());
                 
            }
        return view('publications.index', compact('cities', 'types', 'menus', 'items', 'selectedCity', 'selectedDate', 'selectedTypes', 'selectedPrices', 'sortBy', 'searchTerm'));
    }
    
protected function loadItems(Request $request, $selectedCity, $selectedDate, $selectedTypes, $selectedPrices, $sortBy, $searchTerm, $selectedTypeId, $selectedSubtypeId)
{
    $today = Carbon::today();

    // Base query conditions for both
    $applyEventFilters = function ($query) use ($searchTerm, $selectedTypeId, $selectedSubtypeId) {
        $query->where('confirmed', true);
        if ($searchTerm) {
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }
        if ($selectedTypeId) {
            $query->where('type_id', $selectedTypeId);
        }
        if ($selectedSubtypeId) {
            $query->where('subtype_id', $selectedSubtypeId);
        }
    };

    // PHYSICAL EVENTS
    $physicalQuery = Physical::with(['event.menu', 'event.type', 'event.subtype', 'event.prices', 'city'])
        ->whereHas('event', $applyEventFilters)
        ->where(function ($query) use ($today) {
            $query->whereDate('dateend', '>=', $today)
                  ->orWhere(function ($q) use ($today) {
                      $q->whereNull('dateend')->whereDate('datestart', '>=', $today);
                  });
        });

    // Apply city filter
    if ($selectedCity) {
        $physicalQuery->whereHas('city', fn($q) => $q->where('name', $selectedCity));
    }

    // Apply date filter
    if ($selectedDate) {
        $physicalQuery->where(function ($query) use ($selectedDate) {
            $query->whereBetween('datestart', [$selectedDate, $selectedDate])
                  ->orWhereBetween('dateend', [$selectedDate, $selectedDate]);
        });
    }

    // VIRTUAL EVENTS
    $virtualQuery = Virtual::with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])
        ->whereHas('event', $applyEventFilters)
        ->where(function ($query) use ($today) {
            $query->whereDate('dateend', '>=', $today)
                  ->orWhere(function ($q) use ($today) {
                      $q->whereNull('dateend')->whereDate('datestart', '>=', $today);
                  });
        });

    if ($selectedDate) {
        $virtualQuery->where(function ($query) use ($selectedDate) {
            $query->whereDate('datestart', '<=', $selectedDate)
                  ->whereDate('dateend', '>=', $selectedDate)
                  ->orWhere(function ($q) use ($selectedDate) {
                      $q->whereNull('dateend')->whereDate('datestart', '=', $selectedDate);
                  });
        });
    }

    // Fetch and merge
    $physicals = $physicalQuery->get();
    $virtuals = $virtualQuery->get();

    $items = collect();

    foreach ($physicals as $physical) {
        if ($this->priceFilterMatch($physical, $selectedPrices, 'physical', $selectedTypes)) {
            $items->push($this->transformItem($physical, 'physical'));
        }
    }

    foreach ($virtuals as $virtual) {
        if ($this->priceFilterMatch($virtual, $selectedPrices, 'virtual', $selectedTypes)) {
            $items->push($this->transformItem($virtual, 'virtual'));
        }
    }

    // Sort
    $items = $this->applySorting($items, $sortBy);

    // Paginate once
    $page = $request->get('page', 1);
    $perPage = 10;

    return new LengthAwarePaginator(
        $items->forPage($page, $perPage),
        $items->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );
}
protected function priceFilterMatch($event, $selectedPrices, $type, $selectedTypes)
{
    $typeMatches = empty($selectedTypes) || in_array($type, $selectedTypes);

    $hasPrices = $event->event->prices->isNotEmpty();
    $priceMatches = (
        empty($selectedPrices)
        || (in_array('gratuit', $selectedPrices) && !$hasPrices)
        || (in_array('payant', $selectedPrices) && $hasPrices)
    );

    return $typeMatches && $priceMatches;
}

    
    protected function applyFilters($event, $selectedCity, $selectedDate, $selectedPrices, $selectedTypes, $type)
    {
        $cityMatches = !$selectedCity || ($event->city && $event->city->name === $selectedCity);
        $typeMatches = !$selectedTypes || in_array($type, $selectedTypes);
    
        $hasPrices = $event->event->prices->isNotEmpty();
        $priceMatches = (!$selectedPrices || (in_array('gratuit', $selectedPrices) && !$hasPrices) || (in_array('payant', $selectedPrices) && $hasPrices));
    
        return $cityMatches && $typeMatches && $priceMatches;
    }
    
    protected function transformItem($event, $type)
    {
        $prices = $event->event->prices;
        $lowestPrice = $prices->sortBy('pivot.cost')->first();
    
        return [
            'type' => $type,
            'event' => $event->event,
            'prices' => $prices,
            'datestart' => $event->datestart,
            'id' => $event->id,
            'dateend' => $event->dateend,
            'city' => $event->city ? $event->city->name : null,
            'link' => $event->link,
            'latitude' => $event->latitude,
            'longitude' => $event->longitude,
            'hide' => $event->hide,
            'address' => $event->address,
            'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
            'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
        ];
    }
    
    protected function applySorting($items, $sortBy)
    {
        if ($sortBy == 'pricemin') {
            return $items->sortBy('lowest_cost');
        } elseif ($sortBy == 'pricemax') {
            return $items->sortByDesc('lowest_cost');
        } elseif ($sortBy == 'ds') {
            return $items->sortBy('datestart');
        }
    
        return $items;
    }
}
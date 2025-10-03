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
    
protected function loadItems(Request $request,$selectedCity, $selectedDate, $selectedTypes, $selectedPrices, $sortBy, $searchTerm, $selectedTypeId, $selectedSubtypeId)
{
    $items = collect();
    $today = Carbon::today(); // Get today's date
    
    $physicalEventsQuery = Physical::with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])
        ->whereHas('event', function ($query) use ($searchTerm, $selectedTypeId, $selectedSubtypeId) {
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
        })
        // Add conditions for today <= dateend or today <= datestart if dateend is null
        ->where(function ($query) use ($today) {
            $query->where(function ($subQuery) use ($today) {
                $subQuery->whereDate('dateend', '>=', $today);
            })->orWhere(function ($subQuery) use ($today) {
                $subQuery->whereNull('dateend')
                         ->whereDate('datestart', '>=', $today);
            });
        });

    $virtualEventsQuery = Virtual::with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])
        ->whereHas('event', function ($query) use ($searchTerm, $selectedTypeId, $selectedSubtypeId) {
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
        })
        // Add conditions for today <= dateend or today <= datestart if dateend is null
        ->where(function ($query) use ($today) {
            $query->where(function ($subQuery) use ($today) {
                $subQuery->whereDate('dateend', '>=', $today);
            })->orWhere(function ($subQuery) use ($today) {
                $subQuery->whereNull('dateend')
                         ->whereDate('datestart', '>=', $today);
            });
        });

    if ($selectedDate) {
        $physicalEventsQuery->where(function ($query) use ($selectedDate) {
            $query->where(function ($subQuery) use ($selectedDate) {
                $subQuery->whereDate('datestart', '<=', $selectedDate)
                         ->whereDate('dateend', '>=', $selectedDate);
            })
            ->orWhere(function ($subQuery) use ($selectedDate) {
                $subQuery->whereNull('dateend')
                         ->whereDate('datestart', '=', $selectedDate);
            });
        });

        $virtualEventsQuery->where(function ($query) use ($selectedDate) {
            $query->where(function ($subQuery) use ($selectedDate) {
                $subQuery->whereDate('datestart', '<=', $selectedDate)
                         ->whereDate('dateend', '>=', $selectedDate);
            })
            ->orWhere(function ($subQuery) use ($selectedDate) {
                $subQuery->whereNull('dateend')
                         ->whereDate('datestart', '=', $selectedDate);
            });
        });
    }

    $physicalEvents = $physicalEventsQuery->orderBy('datestart', 'asc')->paginate(5);
    $virtualEvents = $virtualEventsQuery->orderBy('datestart', 'asc')->paginate(5);
  
    
    foreach ($physicalEvents as $physical) {
        if ($this->applyFilters($physical, $selectedCity, $selectedDate, $selectedPrices, $selectedTypes, 'physical')) {
            $items->push($this->transformItem($physical, 'physical'));
        }
    }

    foreach ($virtualEvents as $virtual) {
        if ($this->applyFilters($virtual, $selectedCity, $selectedDate, $selectedPrices, $selectedTypes, 'virtual')) {
            $items->push($this->transformItem($virtual, 'virtual'));
        }
    }

    $items = $this->applySorting($items, $sortBy);

    // return $items->values()->all();

    // Paginate final merged collection manually
    $page = request()->get('page',1);
    $perPage = 10;
    $total =  $physicalEvents->total() +  $virtualEvents->total();

    $paginatedItems = new LengthAwarePaginator(
        $items->forPage(1, $perPage),
        $total,
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    // Optional: if you're using Laravel API resources or JSON
    return $paginatedItems;
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
<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Menu;
use App\Models\Type;
use App\Models\Virtual;
use App\Models\Physical;
use Illuminate\Http\Request;

class MpublicationController extends Controller
{
    public function index(Request $request, $id)
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
    
        $items = $this->loadItems($selectedCity, $selectedDate, $selectedTypes, $selectedPrices, $sortBy, $searchTerm, $selectedTypeId, $selectedSubtypeId, $id);
    
        return view('menus.index', compact('cities', 'types', 'menus', 'items', 'selectedCity', 'selectedDate', 'selectedTypes', 'selectedPrices', 'sortBy', 'searchTerm', 'id'));
    }
    
    protected function loadItems($selectedCity, $selectedDate, $selectedTypes, $selectedPrices, $sortBy, $searchTerm, $selectedTypeId, $selectedSubtypeId, $menuId)
    {
        $items = collect();
        $today = Carbon::today(); // Get today's date
    
        $physicalEventsQuery = Physical::with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])
            ->whereHas('event', function ($query) use ($searchTerm, $selectedTypeId, $selectedSubtypeId, $menuId) {
                $query->where('confirmed', true)
                ->where('menu_id', $menuId); // Filter by menu_id

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
            ->whereHas('event', function ($query) use ($searchTerm, $selectedTypeId, $selectedSubtypeId, $menuId) {
                $query->where('confirmed', true)
                ->where('menu_id', $menuId); // Filter by menu_id                
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
    
        $physicalEvents = $physicalEventsQuery->get();
        $virtualEvents = $virtualEventsQuery->get();
    
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
    
        return $items->values()->all();
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

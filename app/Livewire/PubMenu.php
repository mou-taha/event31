<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;
use App\Models\Menu;
use App\Models\Type;
use App\Models\Virtual;
use App\Models\Physical;

class PubMenu extends Component
{
    public $items = [];
    public $menuId;
    public $selectedCity;
    public $cities = [];

    public function mount($menuId)
    {
        $this->menuId = $menuId;
        $this->loadCities();
        $this->loadItems();
    }

    public function loadCities()
    {
        $this->cities = City::whereHas('physicals.event', function ($query) {
            $query->where('confirmed', true)
                  ->where('menu_id', $this->menuId);
        })->get();
    }

    public function loadItems()
    {
        $this->items = [];

        $physicalEventsQuery = Physical::whereHas('event', function ($query) {
            $query->where('confirmed', true)
                  ->where('menu_id', $this->menuId);
            if ($this->selectedCity) {
                $query->where('city_id', $this->selectedCity);
            }
        })->with(['event.menu', 'event.type', 'event.subtype', 'event.prices', 'city'])->get();

        foreach ($physicalEventsQuery as $physical) {
            $prices = $physical->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $this->items[] = [
                'type' => 'physical',
                'event' => $physical->event,
                'prices' => $prices,
                'datestart' => $physical->datestart,
                'id' => $physical->id,
                'dateend' => $physical->dateend,
                'city' => $physical->city ? $physical->city->name : null,
                'city_id' => $physical->city_id,
                'address' => $physical->address,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ];
        }

        if (!$this->selectedCity) {
            $virtualEventsQuery = Virtual::whereHas('event', function ($query) {
                $query->where('confirmed', true)
                      ->where('menu_id', $this->menuId);
            })->with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])->get();

            foreach ($virtualEventsQuery as $virtual) {
                $prices = $virtual->event->prices;
                $lowestPrice = $prices->sortBy('pivot.cost')->first();
                $this->items[] = [
                    'type' => 'virtual',
                    'event' => $virtual->event,
                    'prices' => $prices,
                    'datestart' => $virtual->datestart,
                    'id' => $virtual->id,
                    'dateend' => $virtual->dateend,
                    'city' => $virtual->city ? $virtual->city->name : null,
                    'city_id' => $virtual->city_id,
                    'address' => $virtual->address,
                    'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                    'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
                ];
            }
        }
    }

    public function filterItems()
    {
        $this->loadItems();
    }

    public function render()
    {
        return view('livewire.pub-menu', [
            'menus' => Menu::all(),
            'types' => Type::all(),
            'cities' => $this->cities,
            'items' => $this->items,
        ]);
    }
}
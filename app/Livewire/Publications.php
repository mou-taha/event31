<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Menu;
use App\Models\Type;
use App\Models\Virtual;
use App\Models\Physical;
use Illuminate\Support\Collection;
use Livewire\Component;

class Publications extends Component
{
    public $items = [];
    public $cities;
    public $types;
    public $selectedCity = null;
    public $selectedDate = null;
    public $selectedTypes = [];
    public $selectedPrices = [];
    public $sortBy = 'ds';

    protected $queryString = [
        'selectedCity' => ['except' => null],
        'selectedDate' => ['except' => null],
        'selectedTypes' => ['except' => []],
        'selectedPrices' => ['except' => []],
        'sortBy' => ['except' => 'ds'],
    ];

    public function mount()
    {
        $this->cities = City::all();
        $this->types = Type::all();
        $this->loadItems();
    }

    public function loadItems()
    {
        $physicalEvents = Physical::whereHas('event', function ($query) {
            $query->where('confirmed', true);
        })->with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])->get();

        $virtualEvents = Virtual::whereHas('event', function ($query) {
            $query->where('confirmed', true);
        })->with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])->get();

        $items = new Collection();

        foreach ($physicalEvents as $physical) {
            $prices = $physical->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $items->push([
                'type' => 'physical',
                'event' => $physical->event,
                'prices' => $prices,
                'datestart' => $physical->datestart,
                'id' => $physical->id,
                'dateend' => $physical->dateend,
                'city' => $physical->city ? $physical->city->name : null,
                'address' => $physical->address,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ]);
        }

        foreach ($virtualEvents as $virtual) {
            $prices = $virtual->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $items->push([
                'type' => 'virtual',
                'event' => $virtual->event,
                'prices' => $prices,
                'datestart' => $virtual->datestart,
                'id' => $virtual->id,
                'dateend' => $virtual->dateend,
                'city' => $virtual->city ? $virtual->city->name : null,
                'address' => $virtual->address,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ]);
        }

        if ($this->selectedCity) {
            $items = $items->where('city', $this->selectedCity);
        }

        if ($this->selectedDate) {
            $items = $items->where('datestart', Carbon::parse($this->selectedDate));
        }

        if ($this->selectedTypes) {
            $items = $items->filter(function ($item) {
                return in_array($item['type'], $this->selectedTypes);
            });
        }

        if ($this->selectedPrices) {
            $items = $items->filter(function ($item) {
                if (in_array('gratuit', $this->selectedPrices) && $item['lowest_cost'] == 0) {
                    return true;
                }
                if (in_array('payant', $this->selectedPrices) && $item['lowest_cost'] > 0) {
                    return true;
                }
                return false;
            });
        }

        if ($this->sortBy == 'ds') {
            $items = $items->sortBy('datestart');
        } elseif ($this->sortBy == 'pricemin') {
            $items = $items->sortBy('lowest_cost');
        } elseif ($this->sortBy == 'pricemax') {
            $items = $items->sortByDesc('lowest_cost');
        }

        $this->items = $items->values()->all();
    }

    public function render()
    {
        return view('livewire.publications', [
            'menus' => Menu::all(),
            'types' => $this->types,
            'cities' => $this->cities,
            'items' => $this->items,
        ]);
    }
}

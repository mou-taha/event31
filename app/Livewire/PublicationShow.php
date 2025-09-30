<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Menu;
use App\Models\Type;
use App\Models\Virtual;
use Livewire\Component;
use App\Models\Physical;
use Illuminate\Support\Facades\Request;

class PublicationShow extends Component
{
    public $event;
    public $type;
    public $items = [];
    public $id;
    public $details = [];
    public $latestSix = [];

    public function mount($type, $id)
    {
        $this->type = $type;
        $this->id = $id;

        if ($type === 'physical') {
            $physical = Physical::with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])->findOrFail($id);
            $prices = $physical->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $this->details = [
                'type' => 'physical',
                'event' => $physical->event,
                'prices' => $prices,
                'datestart' => $physical->datestart,
                'dateend' => $physical->dateend,
                'city' => $physical->city ? $physical->city->name : null,
                'address' => $physical->address,
                'latitude' => $physical->latitude,
                'longitude' => $physical->longitude,
                'id' => $physical->id,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ];
        } elseif ($type === 'virtual') {
            $virtual = Virtual::with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])->findOrFail($id);
            $prices = $virtual->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $this->details = [
                'type' => 'virtual',
                'event' => $virtual->event,
                'prices' => $prices,
                'datestart' => $virtual->datestart,
                'dateend' => $virtual->dateend,
                'city' => $virtual->city ? $virtual->city->name : null,
                'address' => $virtual->address,
                'id' => $virtual->id,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ];
        }

        $this->getLatestSix();
    }

    public function getLatestSix()
    {
        $today = Carbon::today();

        $physicalEvents = Physical::where('datestart', '>=', $today)
            ->with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])
            ->get();

        $virtualEvents = Virtual::where('datestart', '>=', $today)
            ->with(['event.menu', 'event.type', 'event.subtype', 'event.prices'])
            ->get();

        $events = collect();

        foreach ($physicalEvents as $physical) {
            $prices = $physical->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $events->push([
                'type' => 'physical',
                'event' => $physical->event,
                'prices' => $prices,
                'datestart' => $physical->datestart,
                'dateend' => $physical->dateend,
                'city' => $physical->city ? $physical->city->name : null,
                'address' => $physical->address,
                'id' => $physical->id,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ]);
        }

        foreach ($virtualEvents as $virtual) {
            $prices = $virtual->event->prices;
            $lowestPrice = $prices->sortBy('pivot.cost')->first();
            $events->push([
                'type' => 'virtual',
                'event' => $virtual->event,
                'prices' => $prices,
                'datestart' => $virtual->datestart,
                'dateend' => $virtual->dateend,
                'city' => $virtual->city ? $virtual->city->name : null,
                'address' => $virtual->address,
                'id' => $virtual->id,
                'lowest_cost' => $lowestPrice ? $lowestPrice->pivot->cost : null,
                'lowest_price_name' => $lowestPrice ? $lowestPrice->name : null,
            ]);
        }

        $this->latestSix = $events->sortBy('datestart')->take(6)->values()->all();
    }

    public function render()
    {
        return view('livewire.publication-show', [
            'details' => $this->details,
            'menus' => Menu::all(),
            'types' => Type::all(),
            'cities' => City::all(),
            'latestSix' => $this->latestSix,
        ]);
    }
}
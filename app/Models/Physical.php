<?php

namespace App\Models;

use App\Models\City;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Physical extends Model
{
    use HasFactory;

    protected $protected_dates = [
        'datestart',
        'dateend',

    ];
    protected $fillable = ['city_id', 'event_id', 'address', 'longitude', 'latitude', 'datestart','dateend','hide'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

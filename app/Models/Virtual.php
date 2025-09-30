<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Virtual extends Model
{
    use HasFactory;

    protected $protected_dates = [
        'datestart',
        'dateend',

    ];

    protected $fillable = ['event_id','link','content','datestart','dateend','hide'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

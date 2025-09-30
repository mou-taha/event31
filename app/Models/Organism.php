<?php

namespace App\Models;

use App\Models\City;
use App\Models\Event;
use App\Models\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organism extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    protected $with =['city'];
    
    protected $fillable = [
        'city_id',
        'name',
        'slug',
        'email',
        'excerpt',
        'address',
        'content',
        'logo',
        'map',
    ];

    public function exists(): bool
    
        {
            return (bool) $this->id;
        }

    public function city(): BelongsTo
        {
            return $this->belongsTo(City::class);
        }

        public function phones()
        {
            return $this->hasMany(Phone::class);
        }

        public function events()
        {
            return $this->hasMany(Event::class);
        }

//    public function tags(): BelongsToMany
//    {
//        return $this->belongsToMany(Tag::class);
//    }
    
}

<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Price extends Model
{
    use HasFactory;
    
    public function exists(): bool
    {
        return (bool) $this->id;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $fillable = [
        'name',
        'slug',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)->withPivot('cost');
    }

}

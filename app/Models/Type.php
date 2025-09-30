<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Event;
use App\Models\Subtype;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
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
        'menu_id',

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
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function subtypes()
    {
        return $this->hasMany(Subtype::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }

}

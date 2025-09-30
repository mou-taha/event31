<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subtype extends Model
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
        'type_id',

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
        return $this->belongsTo(Type::class);
    }
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

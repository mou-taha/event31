<?php

namespace App\Models;

use App\Models\Organism;
use App\Models\Physical;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
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
    public function organisms()
    {
        return $this->hasMany(Organism::class);
    }
    public function physicals()
    {
        return $this->hasMany(Physical::class);
    }
}

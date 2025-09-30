<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    protected $fillable = [
        'name',
        'slug',
    ];

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

}

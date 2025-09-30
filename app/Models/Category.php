<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
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

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}

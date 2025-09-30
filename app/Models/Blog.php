<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    protected $with =['category', 'user', 'tags'];
    
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
    ];

    public function exists(): bool
        {
            return (bool) $this->id;
        }

    public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }

    public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
        
    public function tags(): BelongsToMany
        {
            return $this->belongsToMany(Tag::class);
        }

    
}

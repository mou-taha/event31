<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Type;
use App\Models\User;
use App\Models\Price;
use App\Models\Subtype;
use App\Models\Virtual;
use App\Models\Organism;
use App\Models\Physical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    protected $with =['menu', 'type', 'subtype', 'organism', 'user'];
    
    protected $fillable = [
        'user_id',
        'menu_id',
        'type_id',
        'subtype_id',
        'organism_id',
        'confirmed',
        'seen',
        'title',
        'slug',
        'subtitle',
        'content',
        'image',
        'link',
    ];

    public function exists(): bool
        {
            return (bool) $this->id;
        }

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function menu(): BelongsTo
        {
            return $this->belongsTo(Menu::class);
        }

        public function type(): BelongsTo
        {
            return $this->belongsTo(Type::class);
        }

        public function subtype(): BelongsTo
        {
            return $this->belongsTo(Subtype::class);
        }

        public function organism(): BelongsTo
        {
            return $this->belongsTo(Organism::class);
        }

        public function virtuals()
        {
            return $this->hasMany(Virtual::class);
        }
        
        public function physicals()
        {
            return $this->hasMany(Physical::class);
        }

        public function prices()
        {
            return $this->belongsToMany(Price::class)->withPivot('cost');
        }

        public function favoritedByUsers(): BelongsToMany
        {
            return $this->belongsToMany(User::class, 'event_user')->withTimestamps();
        }

}

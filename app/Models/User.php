<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Blog;
use App\Models\Event;
use Laravel\Prompts\Concerns\Events;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'username',
        'phone',
        'birth',
        'sex',
        'image',
        'phone',
        'address',
        'bio',
        'google_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function favoriteEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_user')->withTimestamps();
    }
    
    public function scopeSearch($query, $value){
        $query->where('name','like',"%{$value}%")->orWhere('email','like',"%{$value}%");
    }
    
    
}

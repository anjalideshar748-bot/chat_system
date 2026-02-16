<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\friend;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    // app/Models/User.php

//
    /**
     * Get all of the friend for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function friend(): HasMany
    {
        return $this->hasMany(friend::class, 'user_id');
    }
     public function friendRequests(): HasMany
    {
        return $this->hasMany(Friend::class, 'friend_id');
    }
    /**
     * Get all of the chat for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   

/**
 * Get all of the message for the User
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function message(): HasMany
{
    return $this->hasMany(message::class);
}




}

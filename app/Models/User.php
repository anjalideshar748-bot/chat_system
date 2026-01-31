<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Friendship;

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

public function friends()
{
    return $this->belongsToMany(
        User::class,
        'friendships',
        'user_id',
        'friend_id'
    )->wherePivot('status', 'accepted');
}

public function sentFriendRequests()
{
    return $this->hasMany(Friendship::class, 'user_id')
                ->where('status', 'pending');
}

public function receivedFriendRequests()
{
    return $this->hasMany(Friendship::class, 'friend_id')
                ->where('status', 'pending');
}

}


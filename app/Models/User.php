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

/**
 * Get the user's online status
 *
 * @return bool
 */
public function getIsOnlineAttribute()
{
    return \Illuminate\Support\Facades\Cache::has('user-is-online-' . $this->id);
}

/**
 * Generate RSA keys for the user if they do not exist
 *
 * @return void
 */
public function generateRsaKeys()
{
    if (!$this->public_key || !$this->private_key) {
        $config = array(
            "config" => "C:/xampp/php/extras/ssl/openssl.cnf",
            "digest_alg" => "sha512",
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        );

        $res = openssl_pkey_new($config);

        // Use Laravel key as passphrase to encrypt the private key
        $passphrase = config('app.key');
        openssl_pkey_export($res, $privKey, $passphrase, $config);

        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey["key"];

        $this->private_key = $privKey;
        $this->public_key = $pubKey;
        $this->save();
    }
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'encrypted_message',
        'encrypted_key_sender',
        'encrypted_key_receiver',
        'iv'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getMessageAttribute()
    {
        $user = auth()->user();

        if (!$user || !$user->private_key || !$this->iv) {
            return "Message could not be decrypted.";
        }

        $aesKey = null;

        // Use Laravel app key as the passphrase for the encrypted private key
        $passphrase = config('app.key');
        $privateKey = array($user->private_key, $passphrase);

        if ($this->sender_id == $user->id) {
            openssl_private_decrypt(base64_decode($this->encrypted_key_sender), $aesKey, $privateKey);
        } elseif ($this->receiver_id == $user->id) {
            openssl_private_decrypt(base64_decode($this->encrypted_key_receiver), $aesKey, $privateKey);
        }

        if (!$aesKey) {
            return "Decryption failed.";
        }

        $decrypted = openssl_decrypt(base64_decode($this->encrypted_message), 'AES-256-CBC', $aesKey, 0, base64_decode($this->iv));
        return $decrypted !== false ? $decrypted : "Decryption failed.";
    }
}

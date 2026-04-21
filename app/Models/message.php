<?php

namespace App\Models;

use App\Support\AttachmentCompression;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;



class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'encrypted_message',
        'encrypted_key_sender',
        'encrypted_key_receiver',
        'iv',
        'file',
    ];

    protected $appends = [
        'file_meta',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function getFileMetaAttribute(): ?array
    {
        if (!$this->file) {
            return null;
        }

        $decoded = json_decode($this->file, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $path = $decoded['path'] ?? null;
            $storagePath = $decoded['storage_path'] ?? null;
            $compressedSize = isset($decoded['compressed_size']) ? (int) $decoded['compressed_size'] : null;
            $originalSize = isset($decoded['size']) ? (int) $decoded['size'] : null;
            $routeUrl = $storagePath ? route('message.attachment', ['message' => $this->id]) : null;
            $url = $decoded['url'] ?? ($routeUrl ?: ($path ? asset($path) : null));

            return [
                'name' => $decoded['name'] ?? 'Attachment',
                'mime' => $decoded['mime'] ?? 'application/octet-stream',
                'size' => $originalSize,
                'compressed_size' => $compressedSize,
                'size_label' => AttachmentCompression::formatBytes($originalSize),
                'compressed_size_label' => AttachmentCompression::formatBytes($compressedSize),
                'compression' => $decoded['compression'] ?? null,
                'path' => $path,
                'storage_path' => $storagePath,
                'url' => $url,
                'download_url' => $storagePath ? route('message.attachment', ['message' => $this->id, 'download' => 1]) : $url,
                'is_image' => Str::startsWith($decoded['mime'] ?? '', 'image/'),
            ];
        }

        if (Str::startsWith($this->file, 'data:')) {
            preg_match('/^data:([^;]+);base64,/', $this->file, $matches);
            $mime = $matches[1] ?? 'image/*';

            return [
                'name' => 'Attachment',
                'mime' => $mime,
                'size' => null,
                'path' => null,
                'url' => $this->file,
                'is_image' => Str::startsWith($mime, 'image/'),
            ];
        }

        if (!Str::contains($this->file, ['/']) && strlen($this->file) > 100) {
            return [
                'name' => 'Attachment',
                'mime' => 'image/*',
                'size' => null,
                'path' => null,
                'url' => 'data:image/*;base64,' . $this->file,
                'is_image' => true,
            ];
        }

        return [
            'name' => basename($this->file),
            'mime' => 'application/octet-stream',
            'size' => null,
            'path' => $this->file,
            'url' => asset($this->file),
            'is_image' => false,
        ];
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

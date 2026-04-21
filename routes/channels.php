<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('chat.conversation.{firstUserId}.{secondUserId}', function ($user, $firstUserId, $secondUserId) {
    $userId = (int) $user->id;

    return $userId === (int) $firstUserId || $userId === (int) $secondUserId;
});



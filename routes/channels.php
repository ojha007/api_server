<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('mibsoftChat.admin', function () {
    \Illuminate\Support\Facades\Log::error('Admin Routing');
    $auth = auth()->user();
    if ($auth && $auth->is_super) {
        return true;
    }
    return true;
});

Broadcast::channel('mibsoftClientChat.{identifier}', function ($identifier) {
    \Illuminate\Support\Facades\Log::error($identifier);
    \Illuminate\Support\Facades\Log::error('Client Routing');
    return true;
});

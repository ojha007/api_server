<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

Broadcast::channel('mibsoftChat.admin', function () {
    $auth = auth()->user();
    if ($auth && $auth->is_super) {
        return true;
    }
    return true;
});

Broadcast::channel('mibsoftClientChat.{identifier}', function ($id) {
    \Illuminate\Support\Facades\Log::info($id);
    return true;
});

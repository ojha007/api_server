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
    return false;
});

Broadcast::channel('mibsoftChat.{identifier}', function () {
    return true;
});

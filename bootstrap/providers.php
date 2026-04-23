<?php

use App\Providers\AppServiceProvider;
use App\Providers\BroadcastServiceProvider; // ← Tambahkan import ini


return [
    AppServiceProvider::class,
    BroadcastServiceProvider::class, // ← Tambahkan provider ini
];

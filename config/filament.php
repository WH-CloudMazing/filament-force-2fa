<?php

use CloudMazing\FilamentForce2FA\Http\Middleware\RedirectToTwoFactorSettings;

return [

    'middleware' => [
        'auth' => [
            RedirectToTwoFactorSettings::class,
        ],
    ],

];

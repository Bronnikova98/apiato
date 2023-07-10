<?php

return [

    /*
    |--------------------------------------------------------------------------
    | UserSection Section Authorization Container
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Admin Role
    |--------------------------------------------------------------------------
    |
    | This role is used across the app as the main authority e.g. super admin role
    |
    */

    'admin_role' => env('ADMIN_ROLE', 'admin'),
    'developer_role' => env('DEVELOER_ROLE', 'developer'),
];

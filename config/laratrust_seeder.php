<?php

return [
    'role_structure' => [
        'admin' => [
            'drivers' => 'c,r,u,d',
            'cars' => 'c,r,u,d',
            'car_types' => 'c,r,u,d',
            'car_statuses' => 'c,r,u,d',
        ],
        'driver' => [

        ],

    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

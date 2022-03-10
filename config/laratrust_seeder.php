<?php

return [
    'role_structure' => [
        'super' => [
            'users'      => 'c,r,u,d',
            'roles'      => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'units'      => 'c,r,u,d',
            'services'   => 'c,r,u,d',
            'employees'  => 'c,r,u,d',
            'supervisors'=> 'c,r,u,d',
            'guests'     => 'c,r,u,d',
            'orders'     => 'c,r,u,d',
            'hotels'     => 'c,r,u,d',
            'type_rooms' => 'c,r,u,d',
            'floors'     => 'c,r,u,d',
            'rooms'      => 'c,r,u,d',
            'identity_types'=>'c,r,u,d',
            'currencies' => 'c,r,u,d',
            'payments'   => 'c,r,u,d',
            'evaluations'=> 'c,r,u,d',

        ],
    ],
    // 'permission_structure' => [
    //     'cru_user' => [
    //         'profile' => 'c,r,u'
    //     ],
    // ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

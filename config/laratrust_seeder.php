<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'employee' => 'c,r,u,d',
            'department' => 'c,r,u,d',
            'task' => 'c,r,u,d',
            'assign_task' => 'c,r,u,d'
        ],
        'manager' => [
            'employee' => 'c,r,u,d',
            'department' => 'r',
            'task' => 'c,r,u,d',
            'assign_task' => 'c,r'
        ],
        'employee' => [
            'employee' => 'r',
            'department' => 'r',
            'assign_task' => 'r,u'
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];

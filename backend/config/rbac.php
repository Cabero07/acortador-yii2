<?php

return [
    'roles' => [
        'admin' => [
            'permissions' => [
                'manageBackend',
                'manageUsers',
                'disableUsers',
            ],
        ],
        'userplus' => [
            'permissions' => [
                'useAdvancedFeatures',
            ],
        ],
        'user' => [
            'permissions' => [
                'useBasicFeatures',
            ],
        ],
    ],
];
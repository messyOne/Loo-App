<?php

return [
    'default_layout' => 'default',
    'application_name' => 'Loo - Framework',

    'layout_paths' => [
        'default' => 'layout/default',
    ],

    'entity_paths' => [
        Loo\Helper\ClassHelper::namespaceToPath(User\Entity\User::class, 'src/', true),
    ],
];

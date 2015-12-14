<?php

return [
    'default_layout' => 'default',
    'application_name' => 'Loo - Framework',

    'app_path' => 'src/',

    'layout_templates' => [
        'default' => 'layout/default',
    ],

    'entity_paths' => [
        Loo\Helper\ClassHelper::namespaceToPath(User\Entity\User::class, 'src/', true),
    ],
];

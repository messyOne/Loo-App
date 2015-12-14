<?php
// TODO rename to public
return [
    'default_layout' => 'default',
    'application_name' => 'Loo - Framework',

    'app_path' => 'src/',

    // TODO rename to layout_templates
    'layout_paths' => [
        'default' => 'layout/default',
    ],

    'entity_paths' => [
        Loo\Helper\ClassHelper::namespaceToPath(User\Entity\User::class, 'src/', true),
    ],
];

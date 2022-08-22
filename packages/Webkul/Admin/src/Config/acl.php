<?php

return [
    // DASHBOARD
    [
        'key'   => 'dashboard',
        'name'  => 'admin::app.layouts.dashboard',
        'route' => 'admin.dashboard.index',
        'sort'  => 1,
    ],

    // SUPPLIERS
    [
        'key'   => 'persons',
        'name'  => 'admin::app.acl.persons',
        'route' => 'admin.contacts.persons.index',
        'sort'  => 2,
    ], [
        'key'   => 'persons.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.contacts.persons.create', 'admin.contacts.persons.store'],
        'sort'  => 1,
    ], [
        'key'   => 'persons.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.contacts.persons.edit', 'admin.contacts.persons.update'],
        'sort'  => 2,
    ], [
        'key'   => 'persons.view',
        'name'  => 'admin::app.acl.view',
        'route' => ['admin.contacts.persons.view', 'admin.contacts.persons.view'],
        'sort'  => 3,
    ], [
        'key'   => 'persons.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.contacts.persons.delete', 'admin.contacts.persons.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'persons.export',
        'name'  => 'admin::app.acl.export',
        'route' => 'ui.datagrid.export',
        'sort'  => 5,
    ],


    // PRODUCTS
    [
        'key'   => 'products',
        'name'  => 'admin::app.acl.products',
        'route' => 'admin.products.index',
        'sort'  => 3,
    ], [
        'key'   => 'products.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.products.create', 'admin.products.store'],
        'sort'  => 1,
    ], [
        'key'   => 'products.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.products.edit', 'admin.products.update'],
        'sort'  => 2,
    ], [
        'key'   => 'products.view',
        'name'  => 'admin::app.acl.view',
        'route' => ['admin.products.view', 'admin.products.view'],
        'sort'  => 3,
    ], [
        'key'   => 'products.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.products.delete', 'admin.products.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'products.export',
        'name'  => 'admin::app.acl.export',
        'route' => 'ui.datagrid.export',
        'sort'  => 5,
    ],

    // PURCHASE REQUEST
    [
        'key'   => 'purchases',
        'name'  => 'admin::app.acl.purchases',
        'route' => 'admin.purchases.index',
        'sort'  => 4,
    ], [
        'key'   => 'purchases.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.purchases.create', 'admin.purchases.store'],
        'sort'  => 1,
    ], [
        'key'   => 'purchases.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.purchases.edit', 'admin.purchases.update'],
        'sort'  => 2,
    ], [
        'key'   => 'purchases.view',
        'name'  => 'admin::app.acl.view',
        'route' => ['admin.purchases.view', 'admin.purchases.view'],
        'sort'  => 3,
    ], [
        'key'   => 'purchases.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.purchases.delete', 'admin.purchases.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'purchases.print',
        'name'  => 'admin::app.acl.print',
        'route' => ['admin.materials.print', 'admin.materials.print'],
        'sort'  => 5,
    ],

    // PURCHASE INBOUND
    [
        'key'   => 'purchases-orders',
        'name'  => 'admin::app.acl.purchase_inb',
        'route' => 'admin.purchases-orders.index',
        'sort'  => 5,
    ],

    // QUOTATIONS
    [
        'key'   => 'quotes',
        'name'  => 'admin::app.acl.quotes',
        'route' => 'admin.quotes.index',
        'sort'  => 6,
    ], [
        'key'   => 'quotes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.quotes.create', 'admin.quotes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'quotes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.quotes.edit', 'admin.quotes.update'],
        'sort'  => 2,
    ], [
        'key'   => 'quotes.view',
        'name'  => 'admin::app.acl.view',
        'route' => ['admin.quotes.view', 'admin.quotes.view'],
        'sort'  => 3,
    ], [
        'key'   => 'quotes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.quotes.delete', 'admin.quotes.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'quotes.print',
        'name'  => 'admin::app.acl.print',
        'route' => 'admin.quotes.print',
        'sort'  => 5,
    ],

    // MATERIAL REQUEST
    [
        'key'   => 'materials',
        'name'  => 'admin::app.acl.materials',
        'route' => 'admin.materials.index',
        'sort'  => 7,
    ], [
        'key'   => 'materials.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.materials.create', 'admin.materials.store'],
        'sort'  => 1,
    ], [
        'key'   => 'materials.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.materials.edit', 'admin.materials.update'],
        'sort'  => 2,
    ], [
        'key'   => 'materials.view',
        'name'  => 'admin::app.acl.view',
        'route' => ['admin.materials.view', 'admin.materials.view'],
        'sort'  => 3,
    ], [
        'key'   => 'materials.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.materials.delete', 'admin.materials.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'materials.print',
        'name'  => 'admin::app.acl.print',
        'route' => 'admin.materials.print',
        'sort'  => 5,
    ],

    // STOCK COUNT
    [
        'key'   => 'stocks',
        'name'  => 'admin::app.acl.stocks',
        'route' => 'admin.stocks.index',
        'sort'  => 8,
    ], [
        'key'   => 'stocks.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.stocks.create', 'admin.stocks.store'],
        'sort'  => 1,
    ], [
        'key'   => 'stocks.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.stocks.edit', 'admin.stocks.update'],
        'sort'  => 2,
    ], [
        'key'   => 'stocks.view',
        'name'  => 'admin::app.acl.view',
        'route' => ['admin.stocks.view', 'admin.stocks.view'],
        'sort'  => 3,
    ], [
        'key'   => 'stocks.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.stocks.delete', 'admin.stocks.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'stocks.print',
        'name'  => 'admin::app.acl.print',
        'route' => 'admin.stocks.print',
        'sort'  => 5,
    ],

    // SETTINGS DEPARTMENT
    [
        'key'   => 'settings',
        'name'  => 'admin::app.acl.settings',
        'route' => 'admin.settings.index',
        'sort'  => 9,
    ], [
        'key'   => 'settings.user',
        'name'  => 'admin::app.acl.user',
        'route' => ['admin.settings.groups.index', 'admin.settings.roles.index', 'admin.settings.users.index'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups',
        'name'  => 'admin::app.acl.groups',
        'route' => 'admin.settings.groups.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.groups.create', 'admin.settings.groups.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.groups.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.groups.edit', 'admin.settings.groups.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.groups.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.groups.delete',
        'sort'  => 3,
    ],

    // SETTINGS ROLES
    [
        'key'   => 'settings.user.roles',
        'name'  => 'admin::app.acl.roles',
        'route' => 'admin.settings.roles.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.roles.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.roles.create', 'admin.settings.roles.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.roles.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.roles.edit', 'admin.settings.roles.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.roles.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.roles.delete',
        'sort'  => 3,
    ],

    // SETTINGS USER
    [
        'key'   => 'settings.user.users',
        'name'  => 'admin::app.acl.users',
        'route' => 'admin.settings.users.index',
        'sort'  => 3,
    ], [
        'key'   => 'settings.user.users.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.users.create', 'admin.settings.users.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.user.users.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.users.edit', 'admin.settings.users.update', 'admin.settings.users.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.user.users.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.users.delete', 'admin.settings.users.mass_delete'],
        'sort'  => 3,
    ],

    // SETTINGS AUTOMATION
    [
        'key'   => 'settings.automation',
        'name'  => 'admin::app.acl.automation',
        'route' => ['admin.settings.attributes.index', 'admin.settings.email_templates.index', 'admin.settings.workflows.index'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.automation.attributes',
        'name'  => 'admin::app.acl.attributes',
        'route' => 'admin.settings.attributes.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.attributes.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.attributes.create', 'admin.settings.attributes.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.automation.attributes.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.attributes.edit', 'admin.settings.attributes.update', 'admin.settings.attributes.mass_update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.automation.attributes.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => 'admin.settings.attributes.delete',
        'sort'  => 3,
    ],

    // OTHER SETTINGS
    [
        'key'   => 'settings.other_settings',
        'name'  => 'admin::app.acl.other-settings',
        'route' => 'admin.settings.currencies.index',
        'sort'  => 4,
    ], [
        'key'   => 'settings.other_settings.currencies',
        'name'  => 'admin::app.acl.currencies',
        'route' => 'admin.settings.currencies.index',
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.currencies.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.currencies.create', 'admin.settings.currencies.store'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.other_settings.currencies.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.currencies.edit', 'admin.settings.currencies.update'],
        'sort'  => 3,
    ], [
        'key'   => 'settings.other_settings.currencies.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.currencies.delete', 'admin.settings.currencies.mass_delete'],
        'sort'  => 4,
    ], [
        'key'   => 'settings.other_settings.locations',
        'name'  => 'admin::app.acl.locations',
        'route' => 'admin.settings.locations.index',
        'sort'  => 2,
    ], [
        'key'   => 'settings.other_settings.locations.create',
        'name'  => 'admin::app.acl.create',
        'route' => ['admin.settings.locations.create', 'admin.settings.locations.store'],
        'sort'  => 1,
    ], [
        'key'   => 'settings.other_settings.locations.edit',
        'name'  => 'admin::app.acl.edit',
        'route' => ['admin.settings.locations.edit', 'admin.settings.locations.update'],
        'sort'  => 2,
    ], [
        'key'   => 'settings.other_settings.locations.delete',
        'name'  => 'admin::app.acl.delete',
        'route' => ['admin.settings.locations.delete', 'admin.settings.locations.mass_delete'],
        'sort'  => 3,
    ],

    // CONFIGURATION
    [
        'key'   => 'configuration',
        'name'  => 'admin::app.acl.configuration',
        'route' => 'admin.configuration.index',
        'sort'  => 10,
    ]
];

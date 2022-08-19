<?php

/**
 * Param and their desciption
 * key: unique key for menu icon,
 * name: name of menu icon,
 * route: route name for your menu icon,
 * sort: sort number on which your menu icon should display,
 * icon-class: class for menu icon
 * **/

return [
    [
        'key'        => 'dashboard',
        'name'       => 'admin::app.layouts.dashboard',
        'route'      => 'admin.dashboard.index',
        'sort'       => 1,
        'icon-class' => 'dashboard-icon',
    ],

    // SUPPLIER REGISTRATION
    [
        'key'        => 'persons',
        'name'       => 'admin::app.layouts.persons',
        'info'       => 'admin::app.layouts.persons-info',
        'route'      => 'admin.contacts.persons.index',
        'sort'       => 2,
        'icon-class' => 'leads-icon',
    ],

    // PRODUCT MENU
    [
        'key'        => 'products',
        'name'       => 'admin::app.layouts.products',
        'route'      => 'admin.products.index',
        'sort'       => 3,
        'icon-class' => 'products-icon',
    ],

    // PURCHASE REQ and PURCHASE ORDER MENU
    [
        'key'        => 'purchases',
        'name'       => 'admin::app.layouts.purchases',
        'route'      => 'admin.purchases.index',
        'sort'       => 4,
        'icon-class' => 'activities-icon',
    ], [
        'key'        => 'purchases.requests',
        'name'       => 'admin::app.layouts.purchases_req',
        'route'      => 'admin.purchases.index',
        'sort'       => 1,
    ], [
        'key'        => 'purchases.orders',
        'name'       => 'admin::app.layouts.purchases_order',
        'route'      => 'admin.purchases-orders.index',
        'sort'       => 2,
    ],

    // SALES AND QUOTATION MENU
    [
        'key'        => 'sales',
        'name'       => 'admin::app.layouts.quotes',
        'route'      => 'admin.quotes.index',
        'sort'       => 5,
        'icon-class' => 'quotes-icon',
    ],

    // STOCK COUNT
    [
        'key'        => 'stocks',
        'name'       => 'admin::app.dashboard.stock_count',
        'route'      => 'admin.stocks.index',
        'sort'       => 7,
        'icon-class' => 'activities-icon',
    ],

    // MATERIAL REQ.
    [
        'key'        => 'materials',
        'name'       => 'admin::app.layouts.materials',
        'route'      => 'admin.materials.index',
        'sort'       => 6,
        'icon-class' => 'leads-icon',
    ],

    // SETTINGS MENU
    [
        'key'        => 'settings',
        'name'       => 'admin::app.layouts.settings',
        'route'      => 'admin.settings.index',
        'sort'       => 8,
        'icon-class' => 'settings-icon',
    ], [
        'key'        => 'settings.user',
        'name'       => 'admin::app.layouts.user',
        'route'      => 'admin.settings.groups.index',
        'info'       => 'admin::app.layouts.user-info',
        'sort'       => 1,
    ], [
        'key'        => 'settings.user.groups',
        'name'       => 'admin::app.layouts.groups',
        'info'       => 'admin::app.layouts.groups-info',
        'route'      => 'admin.settings.groups.index',
        'sort'       => 1,
        'icon-class' => 'group-icon',
    ], [
        'key'        => 'settings.user.roles',
        'name'       => 'admin::app.layouts.roles',
        'info'       => 'admin::app.layouts.roles-info',
        'route'      => 'admin.settings.roles.index',
        'sort'       => 2,
        'icon-class' => 'role-icon',
    ], [
        'key'        => 'settings.user.users',
        'name'       => 'admin::app.layouts.users',
        'info'       => 'admin::app.layouts.users-info',
        'route'      => 'admin.settings.users.index',
        'sort'       => 3,
        'icon-class' => 'user-icon',
    ], [
        'key'        => 'settings.other_settings',
        'name'       => 'admin::app.layouts.other-settings',
        'info'       => 'admin::app.layouts.other-settings-info',
        'route'      => 'admin.settings.tags.index',
        'sort'       => 9,
        'icon-class' => 'settings-icon',
    ], [
        'key'        => 'settings.other_settings.currencies',
        'name'       => 'admin::app.layouts.currencies',
        'info'       => 'admin::app.layouts.currencies-info',
        'route'      => 'admin.settings.currencies.index',
        'sort'       => 2,
        'icon-class' => 'dollar-circle-icon',
    ], [
        'key'        => 'settings.other_settings.locations',
        'name'       => 'admin::app.locations.title',
        'info'       => 'admin::app.layouts.locations-info',
        'route'      => 'admin.settings.locations.index',
        'sort'       => 1,
        'icon-class' => 'source-icon',
    ], [
        'key'        => 'settings.other_settings.organizations',
        'name'       => 'admin::app.layouts.organizations',
        'route'      => 'admin.contacts.organizations.index',
        'sort'       => 3,
        'icon-class' => 'folder-icon',
    ], [
        'key'        => 'settings.automation',
        'name'       => 'admin::app.layouts.automation',
        'info'       => 'admin::app.layouts.automation-info',
        'route'      => 'admin.settings.attributes.index',
        'sort'       => 10,
    ], [
        'key'        => 'settings.automation.attributes',
        'name'       => 'admin::app.layouts.attributes',
        'info'       => 'admin::app.layouts.attributes-info',
        'route'      => 'admin.settings.attributes.index',
        'sort'       => 1,
        'icon-class' => 'attribute-icon',
    ], [
        'key'        => 'settings.automation.email_templates',
        'name'       => 'admin::app.layouts.email-templates',
        'info'       => 'admin::app.layouts.email-templates-info',
        'route'      => 'admin.settings.email_templates.index',
        'sort'       => 2,
        'icon-class' => 'email-template-icon',
    ], [
        'key'        => 'settings.automation.workflows',
        'name'       => 'admin::app.layouts.workflows',
        'info'       => 'admin::app.layouts.workflows-info',
        'route'      => 'admin.settings.workflows.index',
        'sort'       => 3,
        'icon-class' => 'workflow-icon',
    ],

    // CONFIGURATION MENU
    [
        'key'        => 'configuration',
        'name'       => 'admin::app.layouts.configuration',
        'route'      => 'admin.configuration.index',
        'sort'       => 9,
        'icon-class' => 'tools-icon',
    ]
];

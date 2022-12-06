<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push(trans('admin::app.layouts.dashboard'), route('admin.dashboard.index'));
});


// Dashboard > Contacts
Breadcrumbs::for('contacts', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.contacts'), route('admin.contacts.persons.index'));
});

// Dashboard > Contacts > Persons
Breadcrumbs::for('contacts.persons', function (BreadcrumbTrail $trail) {
    $trail->parent('contacts');
    $trail->push(trans('admin::app.layouts.persons'), route('admin.contacts.persons.index'));
});

// Dashboard > Contacts > Persons > Create
Breadcrumbs::for('contacts.persons.create', function (BreadcrumbTrail $trail) {
    $trail->parent('contacts.persons');
    $trail->push(trans('admin::app.contacts.persons.create-title'), route('admin.contacts.persons.create'));
});

// Dashboard > Contacts > Persons > Edit
Breadcrumbs::for('contacts.persons.edit', function (BreadcrumbTrail $trail, $person) {
    $trail->parent('contacts.persons');
    $trail->push(trans('admin::app.contacts.persons.edit-title'), route('admin.contacts.persons.edit', $person->id));
});

// Dashboard > Contacts > Persons > View
Breadcrumbs::for('contacts.persons.view', function (BreadcrumbTrail $trail, $person) {
    $trail->parent('contacts.persons');
    $trail->push(trans('admin::app.contacts.persons.view-title'), route('admin.contacts.persons.view', $person->id));
});


// Products
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.products'), route('admin.products.index'));
});

// Dashboard > Products > Create Product
Breadcrumbs::for('products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push(trans('admin::app.products.create-title'), route('admin.products.create'));
});

// Dashboard > Products > Edit Product
Breadcrumbs::for('products.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products');
    $trail->push(trans('admin::app.products.edit-title'), route('admin.products.edit', $product->id));
});

// Dashboard > Products > View Product
Breadcrumbs::for('products.view', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('products');
    $trail->push(trans('admin::app.products.view-title'), route('admin.products.view', $product->id));
});


// Purchases
Breadcrumbs::for('purchases', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.purchases'), route('admin.purchases.index'));
});

// Dashboard > Purchases > Create Purchases
Breadcrumbs::for('purchases.create', function (BreadcrumbTrail $trail) {
    $trail->parent('purchases');
    $trail->push(trans('admin::app.purchases.create-title'), route('admin.purchases.create'));
});

// Dashboard > Purchases > Edit Purchases
Breadcrumbs::for('purchases.edit', function (BreadcrumbTrail $trail, $purchase) {
    $trail->parent('purchases');
    $trail->push(trans('admin::app.purchases.edit-title'), route('admin.purchases.edit', $purchase->id));
});

// Dashboard > Purchases > View Purchases
Breadcrumbs::for('purchases.view', function (BreadcrumbTrail $trail, $purchase) {
    $trail->parent('purchases');
    $trail->push(trans('admin::app.purchases.view-title'), route('admin.purchases.view', $purchase->id));
});


// Purchase Order
Breadcrumbs::for('purchases-orders', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.purchases_order'), route('admin.purchases-orders.index'));
});

// Dashboard > Purchases > Create Purchase Order
Breadcrumbs::for('purchases-orders.create', function (BreadcrumbTrail $trail) {
    $trail->parent('purchases-orders');
    $trail->push(trans('admin::app.purchases_order.create-title'), route('admin.purchases-orders.create'));
});

// Dashboard > Purchases > Edit Purchase Order
Breadcrumbs::for('purchases-orders.edit', function (BreadcrumbTrail $trail, $purchase) {
    $trail->parent('purchases-orders');
    $trail->push(trans('admin::app.purchases_order.edit-title'), route('admin.purchases-orders.edit', $purchase->id));
});

// Dashboard > Purchases > View Purchase Order
Breadcrumbs::for('purchases-orders.view', function (BreadcrumbTrail $trail, $purchase) {
    $trail->parent('purchases-orders');
    $trail->push(trans('admin::app.purchases_order.view-title'), route('admin.purchases-orders.view', $purchase->id));
});


// Dashboard > Quotes
Breadcrumbs::for('quotes', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.quotes'), route('admin.quotes.index'));
});

// Dashboard > Quotes > Add Quote
Breadcrumbs::for('quotes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('quotes');
    $trail->push(trans('admin::app.quotes.create-title'), route('admin.quotes.create'));
});

// Dashboard > Quotes > Edit Quote
Breadcrumbs::for('quotes.edit', function (BreadcrumbTrail $trail, $quote) {
    $trail->parent('quotes');
    $trail->push(trans('admin::app.quotes.edit-title'), route('admin.quotes.edit', $quote->id));
});

// Dashboard > Quotes > View Quote
Breadcrumbs::for('quotes.view', function (BreadcrumbTrail $trail, $quote) {
    $trail->parent('quotes');
    $trail->push(trans('admin::app.quotes.view-title'), route('admin.quotes.view', $quote->id));
});


// Dashbord > Sales
Breadcrumbs::for('sales', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.sales'), route('admin.sales.index'));
});

// Dashboard > Sales > Create Sales
Breadcrumbs::for('sales.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sales');
    $trail->push(trans('admin::app.sales.create-title'), route('admin.sales.create'));
});

// Dashboard > Products > Edit Sales
Breadcrumbs::for('sales.edit', function (BreadcrumbTrail $trail, $sale) {
    $trail->parent('sales');
    $trail->push(trans('admin::app.sales.edit-title'), route('admin.sales.edit', $sale->id));
});


// Dashbord > Material Req.
Breadcrumbs::for('materials', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.materials.title'), route('admin.materials.index'));
});

// Dashboard > Material Req. > Create Material Req.
Breadcrumbs::for('materials.create', function (BreadcrumbTrail $trail) {
    $trail->parent('materials');
    $trail->push(trans('admin::app.materials.create-title'), route('admin.materials.create'));
});

// Dashboard > Products > Edit Material Req.
Breadcrumbs::for('materials.edit', function (BreadcrumbTrail $trail, $material) {
    $trail->parent('materials');
    $trail->push(trans('admin::app.materials.edit-title'), route('admin.materials.edit', $material->id));
});

// Dashboard > Products > View Material Req.
Breadcrumbs::for('materials.view', function (BreadcrumbTrail $trail, $material) {
    $trail->parent('materials');
    $trail->push(trans('admin::app.materials.view-title'), route('admin.materials.view', $material->id));
});


// Dashbord > Stock Count
Breadcrumbs::for('stocks', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.stocks.title'), route('admin.stocks.index'));
});

// Dashboard > Stock Count > Create Stock Count
Breadcrumbs::for('stocks.create', function (BreadcrumbTrail $trail) {
    $trail->parent('stocks');
    $trail->push(trans('admin::app.stocks.create-title'), route('admin.stocks.create'));
});

// Dashboard > Products > Edit Stock Count
Breadcrumbs::for('stocks.edit', function (BreadcrumbTrail $trail, $stock) {
    $trail->parent('stocks');
    $trail->push(trans('admin::app.stocks.edit-title'), route('admin.stocks.edit', $stock->id));
});

// Dashboard > Products > View Stock Count
Breadcrumbs::for('stocks.view', function (BreadcrumbTrail $trail, $stock) {
    $trail->parent('stocks');
    $trail->push(trans('admin::app.stocks.view-title'), route('admin.stocks.view', $stock->id));
});


// Dashbord > Incoming Stock
Breadcrumbs::for('incoming-stocks', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.incoming_stocks.title'), route('admin.incoming-stocks.index'));
});

// Dashboard > Stock Count > Create Stock Count
Breadcrumbs::for('incoming-stocks.create', function (BreadcrumbTrail $trail) {
    $trail->parent('incoming-stocks');
    $trail->push(trans('admin::app.incoming_stocks.create-title'), route('admin.incoming-stocks.create'));
});


// Settings
Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.settings'), route('admin.settings.index'));
});

// Settings > Groups
Breadcrumbs::for('settings.groups', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.layouts.groups'), route('admin.settings.groups.index'));
});

// Dashboard > Groups > Create Group
Breadcrumbs::for('settings.groups.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.groups');
    $trail->push(trans('admin::app.settings.groups.create-title'), route('admin.settings.groups.create'));
});

// Dashboard > Groups > Edit Group
Breadcrumbs::for('settings.groups.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('settings.groups');
    $trail->push(trans('admin::app.settings.groups.edit-title'), route('admin.settings.groups.edit', $role->id));
});


// Dashboard > Contacts > Organizations
Breadcrumbs::for('contacts.organizations', function (BreadcrumbTrail $trail) {
    $trail->parent('contacts');
    $trail->push(trans('admin::app.layouts.organizations'), route('admin.contacts.organizations.index'));
});

// Dashboard > Contacts > Organizations > Create
Breadcrumbs::for('contacts.organizations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('contacts.organizations');
    $trail->push(trans('admin::app.contacts.organizations.create-title'), route('admin.contacts.organizations.create'));
});

// Dashboard > Contacts > Organizations > Edit
Breadcrumbs::for('contacts.organizations.edit', function (BreadcrumbTrail $trail, $organization) {
    $trail->parent('contacts.organizations');
    $trail->push(trans('admin::app.contacts.organizations.edit-title'), route('admin.contacts.organizations.edit', $organization->id));
});


// Settings > Roles
Breadcrumbs::for('settings.roles', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.layouts.roles'), route('admin.settings.roles.index'));
});

// Dashboard > Roles > Create Role
Breadcrumbs::for('settings.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.roles');
    $trail->push(trans('admin::app.settings.roles.create-title'), route('admin.settings.roles.create'));
});

// Dashboard > Roles > Edit Role
Breadcrumbs::for('settings.roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('settings.roles');
    $trail->push(trans('admin::app.settings.roles.edit-title'), route('admin.settings.roles.edit', $role->id));
});


// Settings > Users
Breadcrumbs::for('settings.users', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.layouts.users'), route('admin.settings.users.index'));
});

// Dashboard > Users > Create Role
Breadcrumbs::for('settings.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.users');
    $trail->push(trans('admin::app.settings.users.create-title'), route('admin.settings.users.create'));
});

// Dashboard > Users > Edit Role
Breadcrumbs::for('settings.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('settings.users');
    $trail->push(trans('admin::app.settings.users.edit-title'), route('admin.settings.users.edit', $user->id));
});


// Settings > Attributes
Breadcrumbs::for('settings.attributes', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.layouts.attributes'), route('admin.settings.attributes.index'));
});

// Dashboard > Attributes > Create Attribute
Breadcrumbs::for('settings.attributes.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.attributes');
    $trail->push(trans('admin::app.settings.attributes.create-title'), route('admin.settings.attributes.create'));
});

// Dashboard > Attributes > Edit Attribute
Breadcrumbs::for('settings.attributes.edit', function (BreadcrumbTrail $trail, $attribute) {
    $trail->parent('settings.attributes');
    $trail->push(trans('admin::app.settings.attributes.edit-title'), route('admin.settings.attributes.edit', $attribute->id));
});


// Settings > Currencies
Breadcrumbs::for('settings.currencies', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.currencies.title'), route('admin.settings.currencies.index'));
});

// Settings > Currencies > Edit Currencies
Breadcrumbs::for('settings.currencies.edit', function (BreadcrumbTrail $trail, $tag) {
    $trail->parent('settings.currencies');
    $trail->push(trans('admin::app.currencies.edit-title'), route('admin.settings.currencies.edit', $tag->id));
});

// Settings > Locations
Breadcrumbs::for('settings.locations', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.locations.title'), route('admin.settings.locations.index'));
});

// Settings > Locations > Edit
Breadcrumbs::for('settings.locations.edit', function (BreadcrumbTrail $trail, $location) {
    $trail->parent('settings.locations');
    $trail->push(trans('admin::app.locations.edit-title'), route('admin.settings.locations.edit', $location->id));
});

// Settings > Transaction Types
Breadcrumbs::for('settings.transaction-types', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(trans('admin::app.locations.title'), route('admin.settings.locations.index'));
});

// Settings > Transaction Types > Edit
Breadcrumbs::for('settings.transaction-types.edit', function (BreadcrumbTrail $trail, $transactionType) {
    $trail->parent('settings.transaction-types');
    $trail->push(trans('admin::app.locations.edit-title'), route('admin.settings.locations.edit', $transactionType->id));
});


// Configuration
Breadcrumbs::for('configuration', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin::app.layouts.configuration'), route('admin.configuration.index'));
});

// Configuration > Config
Breadcrumbs::for('configuration.slug', function (BreadcrumbTrail $trail, $slug) {
    $trail->parent('configuration');
    $trail->push('', route('admin.configuration.index', ['slug' => $slug]));
});

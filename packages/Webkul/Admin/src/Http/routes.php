<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'Webkul\Admin\Http\Controllers\Controller@redirectToLogin')->name('krayin.home');

    Route::prefix(config('app.admin_path'))->group(function () {

        Route::get('/', 'Webkul\Admin\Http\Controllers\Controller@redirectToLogin');

        // Login Routes
        Route::get('login', 'Webkul\Admin\Http\Controllers\User\SessionController@create')->name('admin.session.create');

        //login post route to admin auth controller
        Route::post('login', 'Webkul\Admin\Http\Controllers\User\SessionController@store')->name('admin.session.store');

        // Forget Password Routes
        Route::get('forgot-password', 'Webkul\Admin\Http\Controllers\User\ForgotPasswordController@create')->name('admin.forgot_password.create');

        Route::post('forgot-password', 'Webkul\Admin\Http\Controllers\User\ForgotPasswordController@store')->name('admin.forgot_password.store');

        // Reset Password Routes
        Route::get('reset-password/{token}', 'Webkul\Admin\Http\Controllers\User\ResetPasswordController@create')->name('admin.reset_password.create');

        Route::post('reset-password', 'Webkul\Admin\Http\Controllers\User\ResetPasswordController@store')->name('admin.reset_password.store');

        Route::get('mail/inbound-parse', 'Webkul\Admin\Http\Controllers\Mail\EmailController@inboundParse')->name('admin.mail.inbound_parse');

        // Admin Routes
        Route::group(['middleware' => ['user']], function () {
            Route::get('logout', 'Webkul\Admin\Http\Controllers\User\SessionController@destroy')->name('admin.session.destroy');

            // Dashboard Route
            Route::get('dashboard', 'Webkul\Admin\Http\Controllers\Admin\DashboardController@index')->name('admin.dashboard.index');

            Route::get('template', 'Webkul\Admin\Http\Controllers\Admin\DashboardController@template')->name('admin.dashboard.template');

            // API routes
            Route::group([
                'prefix'    => 'api',
            ], function () {
                Route::group([
                    'prefix'    => 'dashboard',
                ], function () {
                    Route::get('/', 'Webkul\Admin\Http\Controllers\Admin\DashboardController@getCardData')->name('admin.api.dashboard.card.index');

                    Route::get('/cards', 'Webkul\Admin\Http\Controllers\Admin\DashboardController@getCards')->name('admin.api.dashboard.cards.index');

                    Route::post('/cards', 'Webkul\Admin\Http\Controllers\Admin\DashboardController@updateCards')->name('admin.api.dashboard.cards.update');
                });
            });

            // Account Routes
            Route::group([
                'prefix'    => 'account',
                'namespace' => 'Webkul\Admin\Http\Controllers\User'
            ], function () {
                Route::get('', 'AccountController@edit')->name('admin.user.account.edit');

                Route::put('update', 'AccountController@update')->name('admin.user.account.update');
            });


            // Quotations
            Route::group([
                'prefix'    => 'quotes',
                'namespace' => 'Webkul\Admin\Http\Controllers\Quote',
            ], function () {
                Route::get('', 'QuoteController@index')->name('admin.quotes.index');

                Route::get('create/{id?}', 'QuoteController@create')->name('admin.quotes.create');

                Route::post('create', 'QuoteController@store')->name('admin.quotes.store');

                Route::get('view/{id?}', 'QuoteController@view')->name('admin.quotes.view');

                Route::get('edit/{id?}', 'QuoteController@edit')->name('admin.quotes.edit');

                Route::put('edit/{id}', 'QuoteController@update')->name('admin.quotes.update');

                Route::get('print/{id?}', 'QuoteController@print')->name('admin.quotes.print');

                Route::delete('{id}', 'QuoteController@destroy')->name('admin.quotes.delete');

                Route::put('mass-destroy', 'QuoteController@massDestroy')->name('admin.quotes.mass_delete');
            });


            // New Purchases Request
            Route::group([
                'prefix'    => 'purchases',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product',
            ], function () {
                Route::get('', 'PurchaseController@index')->name('admin.purchases.index');

                Route::get('create/{id?}', 'PurchaseController@create')->name('admin.purchases.create');

                Route::post('create', 'PurchaseController@store')->name('admin.purchases.store');

                Route::get('view/{id?}', 'PurchaseController@view')->name('admin.purchases.view');

                Route::get('edit/{id?}', 'PurchaseController@edit')->name('admin.purchases.edit');

                Route::put('edit/{id}', 'PurchaseController@update')->name('admin.purchases.update');

                Route::get('print/{id?}', 'PurchaseController@print')->name('admin.purchases.print');

                Route::delete('{id}', 'PurchaseController@destroy')->name('admin.purchases.delete');

                Route::put('mass-destroy', 'PurchaseController@massDestroy')->name('admin.purchases.mass_delete');
            });


            // Purchase Orders
            Route::group([
                'prefix'    => 'purchases-orders',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product',
            ], function () {
                Route::get('', 'PurchaseOrderController@index')->name('admin.purchases-orders.index');

                Route::get('create/{id?}', 'PurchaseOrderController@create')->name('admin.purchases-orders.create');

                Route::post('create', 'PurchaseOrderController@store')->name('admin.purchases-orders.store');

                Route::get('view/{id?}', 'PurchaseOrderController@view')->name('admin.purchases-orders.view');

                Route::get('edit/{id?}', 'PurchaseOrderController@edit')->name('admin.purchases-orders.edit');

                Route::put('edit/{id}', 'PurchaseOrderController@update')->name('admin.purchases-orders.update');

                Route::get('print/{id?}', 'PurchaseOrderController@print')->name('admin.purchases-orders.print');

                Route::delete('{id}', 'PurchaseOrderController@destroy')->name('admin.purchases-orders.delete');

                Route::put('mass-destroy', 'PurchaseOrderController@massDestroy')->name('admin.purchases-orders.mass_delete');
            });


            // Products Routes
            Route::group([
                'prefix'    => 'products',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product'
            ], function () {
                Route::get('', 'ProductController@index')->name('admin.products.index');

                Route::get('create', 'ProductController@create')->name('admin.products.create');

                Route::post('create', 'ProductController@store')->name('admin.products.store');

                Route::get('edit/{id}', 'ProductController@edit')->name('admin.products.edit');

                Route::get('view/{id?}', 'ProductController@view')->name('admin.products.view');

                Route::put('edit/{id}', 'ProductController@update')->name('admin.products.update');

                Route::get('search', 'ProductController@search')->name('admin.products.search');

                Route::delete('{id}', 'ProductController@destroy')->name('admin.products.delete');

                Route::put('mass-destroy', 'ProductController@massDestroy')->name('admin.products.mass_delete');
            });


            // Stock Count
            Route::group([
                'prefix'    => 'stocks',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product'
            ], function () {
                Route::get('', 'StockCountController@index')->name('admin.stocks.index');

                Route::get('create', 'StockCountController@create')->name('admin.stocks.create');

                Route::post('create', 'StockCountController@store')->name('admin.stocks.store');

                Route::get('edit/{id}', 'StockCountController@edit')->name('admin.stocks.edit');

                Route::get('view/{id?}', 'StockCountController@view')->name('admin.stocks.view');

                Route::put('edit/{id}', 'StockCountController@update')->name('admin.stocks.update');

                Route::get('search', 'StockCountController@search')->name('admin.stocks.search');

                Route::delete('{id}', 'StockCountController@destroy')->name('admin.stocks.delete');

                Route::put('mass-destroy', 'StockCountController@massDestroy')->name('admin.stocks.mass_delete');
            });


            // Incoming Stock
            Route::group([
                'prefix'    => 'incoming-stocks',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product'
            ], function () {
                Route::get('', 'IncomingStockController@index')->name('admin.incoming-stocks.index');

                Route::get('create', 'IncomingStockController@create')->name('admin.incoming-stocks.create');

                Route::post('create', 'IncomingStockController@store')->name('admin.incoming-stocks.store');

                Route::get('edit/{id}', 'IncomingStockController@edit')->name('admin.incoming-stocks.edit');

                Route::get('view/{id?}', 'IncomingStockController@view')->name('admin.incoming-stocks.view');

                Route::put('edit/{id}', 'IncomingStockController@update')->name('admin.incoming-stocks.update');

                Route::get('search', 'IncomingStockController@search')->name('admin.incoming-stocks.search');

                Route::delete('{id}', 'IncomingStockController@destroy')->name('admin.incoming-stocks.delete');

                Route::put('mass-destroy', 'IncomingStockController@massDestroy')->name('admin.incoming-stocks.mass_delete');
            });


            // Material Requests
            Route::group([
                'prefix'    => 'materials',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product',
            ], function () {
                Route::get('', 'MaterialController@index')->name('admin.materials.index');

                Route::get('create/{id?}', 'MaterialController@create')->name('admin.materials.create');

                Route::post('create', 'MaterialController@store')->name('admin.materials.store');

                Route::get('view/{id?}', 'MaterialController@view')->name('admin.materials.view');

                Route::get('edit/{id?}', 'MaterialController@edit')->name('admin.materials.edit');

                Route::put('edit/{id}', 'MaterialController@update')->name('admin.materials.update');

                Route::get('print/{id?}', 'MaterialController@print')->name('admin.materials.print');

                Route::delete('{id}', 'MaterialController@destroy')->name('admin.materials.delete');

                Route::put('mass-destroy', 'MaterialController@massDestroy')->name('admin.materials.mass_delete');
            });


            // Material Approval List
            Route::group([
                'prefix'    => 'materials-approval',
                'namespace' => 'Webkul\Admin\Http\Controllers\Product',
            ], function () {
                Route::get('', 'MaterialApprovalController@index')->name('admin.materials-approval.index');

                Route::get('create/{id?}', 'MaterialApprovalController@create')->name('admin.materials-approval.create');

                Route::post('create', 'MaterialApprovalController@store')->name('admin.materials-approval.store');

                Route::get('view/{id?}', 'MaterialApprovalController@view')->name('admin.materials-approval.view');

                Route::get('edit/{id?}', 'MaterialApprovalController@edit')->name('admin.materials-approval.edit');

                Route::put('edit/{id}', 'MaterialApprovalController@update')->name('admin.materials-approval.update');

                Route::get('print/{id?}', 'MaterialApprovalController@print')->name('admin.materials-approval.print');

                Route::delete('{id}', 'MaterialApprovalController@destroy')->name('admin.materials-approval.delete');

                Route::put('mass-destroy', 'MaterialApprovalController@massDestroy')->name('admin.materials-approval.mass_delete');
            });


            // Contacts
            Route::group([
                'prefix'    => 'contacts',
                'namespace' => 'Webkul\Admin\Http\Controllers\Contact'
            ], function() {
                // Vendor Routes
                Route::prefix('persons')->group(function () {
                    Route::get('', 'PersonController@index')->name('admin.contacts.persons.index');

                    Route::get('create', 'PersonController@create')->name('admin.contacts.persons.create');

                    Route::post('create', 'PersonController@store')->name('admin.contacts.persons.store');

                    Route::get('view/{id?}', 'PersonController@view')->name('admin.contacts.persons.view');

                    Route::get('edit/{id?}', 'PersonController@edit')->name('admin.contacts.persons.edit');

                    Route::put('edit/{id}', 'PersonController@update')->name('admin.contacts.persons.update');

                    Route::get('search', 'PersonController@search')->name('admin.contacts.persons.search');

                    Route::delete('{id}', 'PersonController@destroy')->name('admin.contacts.persons.delete');

                    Route::put('mass-destroy', 'PersonController@massDestroy')->name('admin.contacts.persons.mass_delete');
                });

                // Organization Routes
                Route::prefix('organizations')->group(function () {
                    Route::get('', 'OrganizationController@index')->name('admin.contacts.organizations.index');

                    Route::get('create', 'OrganizationController@create')->name('admin.contacts.organizations.create');

                    Route::post('create', 'OrganizationController@store')->name('admin.contacts.organizations.store');

                    Route::get('view/{id?}', 'OrganizationController@view')->name('admin.contacts.organizations.view');

                    Route::get('edit/{id?}', 'OrganizationController@edit')->name('admin.contacts.organizations.edit');

                    Route::put('edit/{id}', 'OrganizationController@update')->name('admin.contacts.organizations.update');

                    Route::delete('{id}', 'OrganizationController@destroy')->name('admin.contacts.organizations.delete');

                    Route::put('mass-destroy', 'OrganizationController@massDestroy')->name('admin.contacts.organizations.mass_delete');
                });
            });


            // Settings
            Route::group([
                'prefix'    => 'settings',
                'namespace' => 'Webkul\Admin\Http\Controllers\Setting'
            ], function () {

                Route::get('', 'SettingController@index')->name('admin.settings.index');

                // Departments Routes
                Route::prefix('groups')->group(function () {
                    Route::get('', 'GroupController@index')->name('admin.settings.groups.index');

                    Route::get('create', 'GroupController@create')->name('admin.settings.groups.create');

                    Route::post('create', 'GroupController@store')->name('admin.settings.groups.store');

                    Route::get('edit/{id}', 'GroupController@edit')->name('admin.settings.groups.edit');

                    Route::put('edit/{id}', 'GroupController@update')->name('admin.settings.groups.update');

                    Route::delete('{id}', 'GroupController@destroy')->name('admin.settings.groups.delete');
                });

                // Roles Routes
                Route::prefix('roles')->group(function () {
                    Route::get('', 'RoleController@index')->name('admin.settings.roles.index');

                    Route::get('create', 'RoleController@create')->name('admin.settings.roles.create');

                    Route::post('create', 'RoleController@store')->name('admin.settings.roles.store');

                    Route::get('edit/{id}', 'RoleController@edit')->name('admin.settings.roles.edit');

                    Route::put('edit/{id}', 'RoleController@update')->name('admin.settings.roles.update');

                    Route::delete('{id}', 'RoleController@destroy')->name('admin.settings.roles.delete');
                });

                // Users Routes
                Route::prefix('users')->group(function () {
                    Route::get('', 'UserController@index')->name('admin.settings.users.index');

                    Route::get('create', 'UserController@create')->name('admin.settings.users.create');

                    Route::post('create', 'UserController@store')->name('admin.settings.users.store');

                    Route::get('edit/{id?}', 'UserController@edit')->name('admin.settings.users.edit');

                    Route::put('edit/{id}', 'UserController@update')->name('admin.settings.users.update');

                    Route::delete('{id}', 'UserController@destroy')->name('admin.settings.users.delete');

                    Route::put('mass-update', 'UserController@massUpdate')->name('admin.settings.users.mass_update');

                    Route::put('mass-destroy', 'UserController@massDestroy')->name('admin.settings.users.mass_delete');
                });

                // Attributes Routes
                Route::prefix('attributes')->group(function () {
                    Route::get('', 'AttributeController@index')->name('admin.settings.attributes.index');

                    Route::get('create', 'AttributeController@create')->name('admin.settings.attributes.create');

                    Route::post('create', 'AttributeController@store')->name('admin.settings.attributes.store');

                    Route::get('edit/{id}', 'AttributeController@edit')->name('admin.settings.attributes.edit');

                    Route::put('edit/{id}', 'AttributeController@update')->name('admin.settings.attributes.update');

                    Route::get('lookup/{lookup?}', 'AttributeController@lookup')->name('admin.settings.attributes.lookup');

                    Route::delete('{id}', 'AttributeController@destroy')->name('admin.settings.attributes.delete');

                    Route::put('mass-update', 'AttributeController@massUpdate')->name('admin.settings.attributes.mass_update');

                    Route::put('mass-destroy', 'AttributeController@massDestroy')->name('admin.settings.attributes.mass_delete');

                    Route::get('download', 'AttributeController@download')->name('admin.settings.attributes.download');
                });

                // Lead Pipelines Routes
                Route::prefix('pipelines')->group(function () {
                    Route::get('', 'PipelineController@index')->name('admin.settings.pipelines.index');

                    Route::get('create', 'PipelineController@create')->name('admin.settings.pipelines.create');

                    Route::post('create', 'PipelineController@store')->name('admin.settings.pipelines.store');

                    Route::get('edit/{id?}', 'PipelineController@edit')->name('admin.settings.pipelines.edit');

                    Route::put('edit/{id}', 'PipelineController@update')->name('admin.settings.pipelines.update');

                    Route::delete('{id}', 'PipelineController@destroy')->name('admin.settings.pipelines.delete');
                });

                // Lead Sources Routes
                Route::prefix('sources')->group(function () {
                    Route::get('', 'SourceController@index')->name('admin.settings.sources.index');

                    Route::post('create', 'SourceController@store')->name('admin.settings.sources.store');

                    Route::get('edit/{id?}', 'SourceController@edit')->name('admin.settings.sources.edit');

                    Route::put('edit/{id}', 'SourceController@update')->name('admin.settings.sources.update');

                    Route::delete('{id}', 'SourceController@destroy')->name('admin.settings.sources.delete');
                });

                // Lead Types Routes
                Route::prefix('types')->group(function () {
                    Route::get('', 'TypeController@index')->name('admin.settings.types.index');

                    Route::post('create', 'TypeController@store')->name('admin.settings.types.store');

                    Route::get('edit/{id?}', 'TypeController@edit')->name('admin.settings.types.edit');

                    Route::put('edit/{id}', 'TypeController@update')->name('admin.settings.types.update');

                    Route::delete('{id}', 'TypeController@destroy')->name('admin.settings.types.delete');
                });

                // Email Templates Routes
                Route::prefix('email-templates')->group(function () {
                    Route::get('', 'EmailTemplateController@index')->name('admin.settings.email_templates.index');

                    Route::get('create', 'EmailTemplateController@create')->name('admin.settings.email_templates.create');

                    Route::post('create', 'EmailTemplateController@store')->name('admin.settings.email_templates.store');

                    Route::get('edit/{id?}', 'EmailTemplateController@edit')->name('admin.settings.email_templates.edit');

                    Route::put('edit/{id}', 'EmailTemplateController@update')->name('admin.settings.email_templates.update');

                    Route::delete('{id}', 'EmailTemplateController@destroy')->name('admin.settings.email_templates.delete');
                });

                // Workflows Routes
                Route::prefix('workflows')->group(function () {
                    Route::get('', 'WorkflowController@index')->name('admin.settings.workflows.index');

                    Route::get('create', 'WorkflowController@create')->name('admin.settings.workflows.create');

                    Route::post('create', 'WorkflowController@store')->name('admin.settings.workflows.store');

                    Route::get('edit/{id?}', 'WorkflowController@edit')->name('admin.settings.workflows.edit');

                    Route::put('edit/{id}', 'WorkflowController@update')->name('admin.settings.workflows.update');

                    Route::delete('{id}', 'WorkflowController@destroy')->name('admin.settings.workflows.delete');
                });

                // Tags Routes
                Route::prefix('tags')->group(function () {
                    Route::get('', 'TagController@index')->name('admin.settings.tags.index');

                    Route::post('create', 'TagController@store')->name('admin.settings.tags.store');

                    Route::get('edit/{id?}', 'TagController@edit')->name('admin.settings.tags.edit');

                    Route::put('edit/{id}', 'TagController@update')->name('admin.settings.tags.update');

                    Route::get('search', 'TagController@search')->name('admin.settings.tags.search');

                    Route::delete('{id}', 'TagController@destroy')->name('admin.settings.tags.delete');

                    Route::put('mass-destroy', 'TagController@massDestroy')->name('admin.settings.tags.mass_delete');
                });

                // Currencies
                Route::prefix('currencies')->group(function () {
                    Route::get('', 'CurrencyController@index')->name('admin.settings.currencies.index');

                    Route::post('create', 'CurrencyController@store')->name('admin.settings.currencies.store');

                    Route::get('edit/{id?}', 'CurrencyController@edit')->name('admin.settings.currencies.edit');

                    Route::put('edit/{id}', 'CurrencyController@update')->name('admin.settings.currencies.update');

                    Route::get('search', 'CurrencyController@search')->name('admin.settings.currencies.search');

                    Route::delete('{id}', 'CurrencyController@destroy')->name('admin.settings.currencies.delete');

                    Route::put('mass-destroy', 'CurrencyController@massDestroy')->name('admin.settings.currencies.mass_delete');
                });

                // Locations
                Route::prefix('locations')->group(function () {
                    Route::get('', 'LocationController@index')->name('admin.settings.locations.index');

                    Route::post('create', 'LocationController@store')->name('admin.settings.locations.store');

                    Route::get('edit/{id?}', 'LocationController@edit')->name('admin.settings.locations.edit');

                    Route::put('edit/{id}', 'LocationController@update')->name('admin.settings.locations.update');

                    Route::get('search', 'LocationController@search')->name('admin.settings.locations.search');

                    Route::delete('{id}', 'LocationController@destroy')->name('admin.settings.locations.delete');

                    Route::put('mass-destroy', 'LocationController@massDestroy')->name('admin.settings.locations.mass_delete');
                });

                // Transaction Types
                Route::prefix('transaction-types')->group(function () {
                    Route::get('', 'TransactionTypeController@index')->name('admin.settings.transaction-types.index');

                    Route::post('create', 'TransactionTypeController@store')->name('admin.settings.transaction-types.store');

                    Route::get('edit/{id?}', 'TransactionTypeController@edit')->name('admin.settings.transaction-types.edit');

                    Route::put('edit/{id}', 'TransactionTypeController@update')->name('admin.settings.transaction-types.update');

                    Route::get('search', 'TransactionTypeController@search')->name('admin.settings.transaction-types.search');

                    Route::delete('{id}', 'TransactionTypeController@destroy')->name('admin.settings.transaction-types.delete');

                    Route::put('mass-destroy', 'TransactionTypeController@massDestroy')->name('admin.settings.transaction-types.mass_delete');
                });
            });


            // Configuration Routes
            Route::group([
                'prefix'    => 'configuration',
                'namespace' => 'Webkul\Admin\Http\Controllers\Configuration'
            ], function () {
                Route::get('{slug?}', 'ConfigurationController@index')->name('admin.configuration.index');

                Route::post('{slug?}', 'ConfigurationController@store')->name('admin.configuration.index.store');
            });
        });
    });
});

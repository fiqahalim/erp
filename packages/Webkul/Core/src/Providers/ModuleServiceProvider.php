<?php

namespace Webkul\Core\Providers;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Core\Models\CoreConfig::class,
        \Webkul\Core\Models\Country::class,
        \Webkul\Core\Models\CountryState::class,
        \Webkul\Core\Models\Currency::class,
        \Webkul\Core\Models\Location::class,
        \Webkul\Core\Models\Bank::class,
    ];
}

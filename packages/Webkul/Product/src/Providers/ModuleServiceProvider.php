<?php

namespace Webkul\Product\Providers;

use Webkul\Core\Providers\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Webkul\Product\Models\Product::class,
        \Webkul\Product\Models\Purchase::class,
        \Webkul\Product\Models\PurchaseItem::class,
        \Webkul\Product\Models\Material::class,
        \Webkul\Product\Models\MaterialProduct::class,
        \Webkul\Product\Models\Stock::class,
        \Webkul\Product\Models\PurchaseOrder::class,
        \Webkul\Product\Models\PurchaseOrderItem::class,
    ];
}

<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Product\Repositories\PurchaseRepository;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\User\Repositories\UserRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Core\Repositories\LocationRepository;
use Webkul\Core\Repositories\CurrencyRepository;

use Barryvdh\DomPDF\Facade as PDF;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\PurchaseOrderDataGrid::class)->toJson();
        }

        return view('admin::purchases.orders.index');
    }
}

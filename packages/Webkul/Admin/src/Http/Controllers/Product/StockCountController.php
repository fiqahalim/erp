<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Product\Repositories\ProductRepository;

class StockCountController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\ProductDataGrid::class)->toJson();
        }

        return view('admin::stocks.index');
    }

    public function create()
    {
        return view('admin::stocks.create');
    }
}

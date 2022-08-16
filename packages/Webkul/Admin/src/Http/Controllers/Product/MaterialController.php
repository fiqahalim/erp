<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Product\Repositories\ProductRepository;

class MaterialController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\ProductDataGrid::class)->toJson();
        }

        return view('admin::materials.index');
    }

    public function create()
    {
        return view('admin::materials.create');
    }
}

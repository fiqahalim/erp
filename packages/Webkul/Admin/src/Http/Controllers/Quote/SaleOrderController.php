<?php

namespace Webkul\Admin\Http\Controllers\Quote;

use Illuminate\Support\Facades\Event;
use Barryvdh\DomPDF\Facade as PDF;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Admin\DataGrids\Setting\CurrencyDataGrid;
use Webkul\Quote\Repositories\SaleRepository;

class SaleOrderController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return app(CurrencyDataGrid::class)->toJson();
        }

        return view('admin::sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::sales.create');
    }
}

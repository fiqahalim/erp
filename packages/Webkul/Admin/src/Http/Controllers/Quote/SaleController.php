<?php

namespace Webkul\Admin\Http\Controllers\Quote;

use Illuminate\Support\Facades\Event;
use Barryvdh\DomPDF\Facade as PDF;
use Webkul\Admin\DataGrids\Quote\SaleDataGrid;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Quote\Repositories\SaleRepository;
use Webkul\Core\Repositories\LocationRepository;
use Webkul\Core\Repositories\CurrencyRepository;

class SaleController extends Controller
{
    protected $saleRepository, $currencyRepository;

    public function __construct(
        SaleRepository $saleRepository,
        CurrencyRepository $currencyRepository
    )
    {
        $this->saleRepository = $saleRepository;

        $this->currencyRepository = $currencyRepository;

        request()->request->add(['entity_type' => 'sales']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return app(SaleDataGrid::class)->toJson();
        }

        return view('admin::sales.index');
    }
}

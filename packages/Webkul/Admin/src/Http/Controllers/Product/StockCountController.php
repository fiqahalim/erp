<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Webkul\Product\Repositories\PurchaseOrderItemRepository;
use Webkul\Product\Repositories\StockRepository;
use Webkul\User\Repositories\UserRepository;
use Webkul\User\Repositories\GroupRepository;

use Barryvdh\DomPDF\Facade as PDF;

class StockCountController extends Controller
{
    protected $userRepository, $purchaseOrderItemRepository, $stockRepository, $groupRepository;

    public function __construct(
        UserRepository $userRepository,
        PurchaseOrderItemRepository $purchaseOrderItemRepository,
        StockRepository $stockRepository,
        GroupRepository $groupRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->purchaseOrderItemRepository = $purchaseOrderItemRepository;
        $this->stockRepository = $stockRepository;
        $this->groupRepository = $groupRepository;

        request()->request->add(['entity_type' => 'stocks']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\StockCountDataGrid::class)->toJson();
        }

        return view('admin::stocks.index');
    }

    public function create()
    {
        $users = $this->userRepository->all();
        $groups = $this->groupRepository->all();
        $purchaseOrderItem = $this->purchaseOrderItemRepository->all();

        return view('admin::stocks.create', compact('groups', 'products'));
    }

    public function edit($id)
    {
        $stock = $this->stockRepository->findOrFail($id);
        $products = $this->productRepository->where('id', $stock->product_id)->get();
        $groups = $this->groupRepository->where('id', $stock->group_id)->get();

        return view('admin::stocks.edit', compact('stock', 'products', 'groups'));
    }

    public function view($id)
    {
        $stock = $this->stockRepository->findOrFail($id);

        return view('admin::stocks.show', compact('stock'));
    }
}

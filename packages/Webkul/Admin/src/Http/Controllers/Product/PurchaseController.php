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

class PurchaseController extends Controller
{
    protected $purchaseRepository;
    protected $personRepository;
    protected $userRepository;
    protected $productRepository;
    protected $locationRepository, $currencyRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Product\Repositories\PurchaseRepository  $purchaseRepository
     *
     * @return void
     */
    public function __construct(
        PurchaseRepository $purchaseRepository,
        PersonRepository $personRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        LocationRepository $locationRepository,
        CurrencyRepository $currencyRepository
    )
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->locationRepository = $locationRepository;
        $this->currencyRepository = $currencyRepository;

        request()->request->add(['entity_type' => 'purchases']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\PurchaseDataGrid::class)->toJson();
        }

        return view('admin::purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $persons = $this->personRepository->all();
        $users = $this->userRepository->all();
        $products = $this->productRepository->all();
        $locations = $this->locationRepository->all();
        $currencies = $cthis->currencyRepository->all();

        return view('admin::purchases.create', compact('persons', 'users', 'products', 'locations', 'currencies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin::purchases.edit');
    }

    public function view($id)
    {
        return view('admin::purchases.show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'purchase_no'      => 'required',
            'date'             => 'nullable',
            'user_id'          => 'nullable',
            'person_id'        => 'nullable',
            'product_id'       => 'nullable',
        ]);

        $data = request()->all();

        $purchase = $this->purchaseRepository->create($data);
        $purchase->save();

        session()->flash('success', trans('admin::app.purchases.create-success'));

        return redirect()->route('admin.purchases.index');
    }
}

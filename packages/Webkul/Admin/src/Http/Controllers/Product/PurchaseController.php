<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Webkul\User\Repositories\UserRepository;
use Webkul\Contact\Repositories\PersonRepository;
use Webkul\Product\Repositories\PurchaseRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\PurchaseItemRepository;
use Webkul\Core\Repositories\LocationRepository;
use Webkul\Core\Repositories\CurrencyRepository;
use Webkul\User\Repositories\GroupRepository;

use Barryvdh\DomPDF\Facade as PDF;

class PurchaseController extends Controller
{
    protected $purchaseRepository, $purchaseItemRepository, $productRepository;
    protected $personRepository, $userRepository, $groupRepository;
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
        CurrencyRepository $currencyRepository,
        PurchaseItemRepository $purchaseItemRepository,
        GroupRepository $groupRepository
    )
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->locationRepository = $locationRepository;
        $this->currencyRepository = $currencyRepository;
        $this->purchaseItemRepository = $purchaseItemRepository;
        $this->groupRepository = $groupRepository;

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
        $groups = $this->groupRepository->all();
        $users = auth()->guard('user')->user();
        $products = $this->productRepository->all();
        $locations = $this->locationRepository->all();
        $currencies = $this->currencyRepository->all();

        return view('admin::purchases.create', compact('persons', 'users', 'products', 'locations', 'currencies', 'groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $purchase = $this->purchaseRepository->findOrFail($id);
        $products = $this->purchaseItemRepository->where('purchase_id', $purchase->id)->get();
        $users = $this->userRepository->where('id', $purchase->user_id)->get();
        $persons = $this->personRepository->where('id', $purchase->person_id)->get();
        $locations = $this->locationRepository->where('id', $purchase->location_id)->get();
        $groups = $this->groupRepository->where('id', $purchase->group_id)->get();

        return view('admin::purchases.edit', compact('purchase', 'users', 'products', 'persons', 'locations', 'groups'));
    }

    public function view($id)
    {
        $purchase = $this->purchaseRepository->findOrFail($id);
        $products = $this->purchaseItemRepository->where('purchase_id', $purchase->id)->get();
        $users = $this->userRepository->where('id', $purchase->user_id)->get();
        $persons = $this->personRepository->where('id', $purchase->person_id)->get();
        $locations = $this->locationRepository->where('id', $purchase->location_id)->get();

        return view('admin::purchases.show', compact('purchase', 'users', 'products', 'persons', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'purchase_no'      => 'required|unique:purchases',
            'user_id'          => 'nullable',
            'person_id'        => 'nullable',
            'product_id'       => 'nullable',
        ]);

        $data = request()->all();

        $purchase = $this->purchaseRepository->create($data);
        $purchase->save();

        if (isset($data['products'])) {
            foreach ($data['products'] as $product) {
                $purchaseItemData = $this->purchaseItemRepository->create(array_merge($product, [
                    // 'amount'        => $product['price'] * $product['quantity'],
                    'name'          => $product['name'],
                    'sku'           => $product['sku'],
                    'spec'          => $product['spec'],
                    'quantity'      => $product['quantity'],
                    'unit'          => $product['unit'],
                    'packaging'     => $product['packaging'],
                    'additional_spec'  => $product['additional_spec'],
                    // 'price'         => $product['price'],
                    'purchase_id'   => $purchase->id
                ]));
            }

            $purchaseItemData->save();
        }

        session()->flash('success', trans('admin::app.purchases.create-success'));

        return redirect()->route('admin.purchases.index');
    }

    public function update(Request $request, $id)
    {
        $data = request()->all();

        $purchase = $this->purchaseRepository->update([
            'expired_date'      => request('expired_date'),
            'progress_status'   => request('progress_status'),
            'approved'          => request('approved'),
            'user_id'           => request('user_id'),
            'person_id'         => request('person_id'),
            'location_id'       => request('location_id')
        ], $id);

        if (request('approved') == 1) {
            $approved = $this->purchaseRepository->update([
                'approved_date'     => Carbon::now(),
                'approved_by'       => session('login_user_59ba36addc2b2f9401580f014c7f58ea4e30989d')
            ], $id);
        }

        if (isset($data['products'])) {
            foreach ($data['products'] as $productId => $product) {
                $purchaseItemData = $this->purchaseItemRepository->create(array_merge($product, [
                    // 'amount'        => $product['price'] * $product['quantity'],
                    'name'          => $product['name'],
                    'sku'           => $product['sku'],
                    'spec'          => $product['spec'],
                    'quantity'      => $product['quantity'],
                    'unit'          => $product['unit'],
                    'packaging'     => $product['packaging'],
                    'additional_spec'  => $product['additional_spec'],
                    // 'price'         => $product['price'],
                    'purchase_id'   => $purchase->id
                ]));
            }
            $purchaseItemData->save();
        }

        session()->flash('success', trans('admin::app.purchases.update-success'));

        return redirect()->route('admin.purchases.index');
    }

    /**
     * Search quote results
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = $this->purchaseRepository->findWhere([
            ['purchase_no', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        return response()->json($results);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->purchaseRepository->findOrFail($id);

        try {

            $this->purchaseRepository->delete($id);

            return response()->json([
                'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.purchases.title')]),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.purchases.title')]),
            ], 400);
        }
    }

    /**
     * Mass Delete the specified resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        foreach (request('rows') as $purchaseId) {

            $this->purchaseRepository->delete($purchaseId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.purchases.title')]),
        ]);
    }

    /**
     * Print and download the for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $purchase = $this->purchaseRepository->findOrFail($id);
        $products = $this->purchaseItemRepository->where('purchase_id', $purchase->id)->get();

        return PDF::loadHTML(view('admin::purchases.pdf', compact('purchase', 'products'))->render())
            ->setPaper('a4')
            ->download('Purchase_Request_' . $purchase->purchase_no . '.pdf');
    }
}

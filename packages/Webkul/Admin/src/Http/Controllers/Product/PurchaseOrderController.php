<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\PurchaseOrderRepository;
use Webkul\Product\Repositories\PurchaseOrderItemRepository;
use Webkul\User\Repositories\UserRepository;
use Webkul\Core\Repositories\LocationRepository;
use Webkul\Core\Repositories\CurrencyRepository;
use Webkul\Contact\Repositories\PersonRepository;

use Barryvdh\DomPDF\Facade as PDF;

class PurchaseOrderController extends Controller
{
    protected $purchaseOrderRepository, $purchaseOrderItemRepository, $productRepository;
    protected $personRepository, $userRepository;
    protected $locationRepository, $currencyRepository;

    public function __construct(
        PurchaseOrderRepository $purchaseOrderRepository,
        PersonRepository $personRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        LocationRepository $locationRepository,
        CurrencyRepository $currencyRepository,
        PurchaseOrderItemRepository $purchaseOrderItemRepository
    )
    {
        $this->purchaseOrderRepository = $purchaseOrderRepository;
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->locationRepository = $locationRepository;
        $this->currencyRepository = $currencyRepository;
        $this->purchaseOrderItemRepository = $purchaseOrderItemRepository;

        request()->request->add(['entity_type' => 'purchases']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\PurchaseOrderDataGrid::class)->toJson();
        }

        return view('admin::purchase-orders.index');
    }

    public function create()
    {
        $persons = $this->personRepository->all();
        $users = auth()->guard('user')->user();
        $products = $this->productRepository->all();
        $locations = $this->locationRepository->all();
        $currencies = $this->currencyRepository->all();

        return view('admin::purchase-orders.create', compact('persons', 'users', 'products', 'locations', 'currencies'));
    }

    public function edit($id)
    {
        $purchase = $this->purchaseOrderRepository->findOrFail($id);
        $products = $this->purchaseOrderItemRepository->where('purchase_order_id', $purchase->id)->get();
        $users = $this->userRepository->where('id', $purchase->user_id)->get();
        $persons = $this->personRepository->where('id', $purchase->person_id)->get();
        $locations = $this->locationRepository->where('id', $purchase->location_id)->get();

        return view('admin::purchase-orders.edit', compact('purchase', 'users', 'products', 'persons', 'locations'));
    }

    public function view($id)
    {
        $purchase = $this->purchaseOrderRepository->findOrFail($id);
        $products = $this->purchaseOrderItemRepository->where('purchase_order_id', $purchase->id)->get();
        $users = $this->userRepository->where('id', $purchase->user_id)->get();
        $persons = $this->personRepository->where('id', $purchase->person_id)->get();
        $locations = $this->locationRepository->where('id', $purchase->location_id)->get();

        return view('admin::purchase-orders.show', compact('purchase', 'users', 'products', 'persons', 'locations'));
    }

    public function store()
    {
        $this->validate(request(), [
            'purchase_no'      => 'required|unique:purchase_orders',
            'user_id'          => 'nullable',
            'person_id'        => 'nullable',
            'product_id'       => 'nullable',
        ]);

        $data = request()->all();

        $purchase = $this->purchaseOrderRepository->create($data);
        $purchase->save();

        if (isset($data['products'])) {
            foreach ($data['products'] as $product) {
                $purchaseItemData = $this->purchaseOrderItemRepository->create(array_merge($product, [
                    'amount'            => $product['price'] * $product['quantity'],
                    'name'              => $product['name'],
                    'sku'               => $product['sku'],
                    'description'       => $product['description'],
                    'quantity'          => $product['quantity'],
                    'price'             => $product['price'],
                    'purchase_order_id' => $purchase->id
                ]));
            }

            $purchaseItemData->save();
        }

        session()->flash('success', trans('admin::app.purchases_order.create-success'));

        return redirect()->route('admin.purchases-orders.index');
    }

    public function update(Request $request, $id)
    {
        $data = request()->all();

        $purchase = $this->purchaseOrderRepository->update([
            'expired_date'      => request('expired_date'),
            'progress_status'   => request('progress_status'),
            'approved'          => request('approved'),
            'user_id'           => request('user_id'),
            'person_id'         => request('person_id'),
            'location_id'       => request('location_id')
        ], $id);

        if (request('approved') == 1) {
            $approved = $this->purchaseOrderRepository->update([
                'approved_date'     => Carbon::now(),
                'approved_by'       => session('login_user_59ba36addc2b2f9401580f014c7f58ea4e30989d')
            ], $id);
        }

        if (isset($data['products'])) {
            foreach ($data['products'] as $productId => $product) {
                $purchaseItemData = $this->purchaseOrderItemRepository->create(array_merge($product, [
                    'amount'            => $product['price'] * $product['quantity'],
                    'name'              => $product['name'],
                    'sku'               => $product['sku'],
                    'description'       => $product['description'],
                    'quantity'          => $product['quantity'],
                    'price'             => $product['price'],
                    'purchase_order_id' => $purchase->id
                ]));
            }
            $purchaseItemData->save();
        }

        session()->flash('success', trans('admin::app.purchases_order.update-success'));

        return redirect()->route('admin.purchases-orders.index');
    }

    /**
     * Search quote results
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = $this->purchaseOrderRepository->findWhere([
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
        $this->purchaseOrderRepository->findOrFail($id);

        try {

            $this->purchaseOrderRepository->delete($id);

            return response()->json([
                'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.purchases_order.title')]),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.purchases_order.title')]),
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

            $this->purchaseOrderRepository->delete($purchaseId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.purchases_order.title')]),
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
        $purchase = $this->purchaseOrderRepository->findOrFail($id);
        $products = $this->purchaseOrderItemRepository->where('purchase_order_id', $purchase->id)->get();

        return PDF::loadHTML(view('admin::purchase-orders.pdf', compact('purchase', 'products'))->render())
            ->setPaper('a4')
            ->download('Purchase_Request_' . $purchase->purchase_no . '.pdf');
    }
}

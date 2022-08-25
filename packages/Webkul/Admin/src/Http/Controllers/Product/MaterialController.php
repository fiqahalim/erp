<?php

namespace Webkul\Admin\Http\Controllers\Product;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\MaterialRepository;
use Webkul\Product\Repositories\MaterialProductRepository;
use Webkul\User\Repositories\UserRepository;

use Barryvdh\DomPDF\Facade as PDF;

class MaterialController extends Controller
{
    protected $userRepository, $productRepository, $materialRepository, $materialProductRepository;

    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        MaterialRepository $materialRepository,
        MaterialProductRepository $materialProductRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->materialRepository = $materialRepository;
        $this->materialProductRepository = $materialProductRepository;

        request()->request->add(['entity_type' => 'materials']);
    }

    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Product\MaterialDataGrid::class)->toJson();
        }

        return view('admin::materials.index');
    }

    public function create()
    {
        $users = $this->userRepository->all();
        $products = $this->productRepository->all();

        return view('admin::materials.create', compact('users', 'products'));
    }

    public function edit($id)
    {
        $material = $this->materialRepository->findOrFail($id);
        $products = $this->materialProductRepository->where('material_id', $material->id)->get();
        $users = $this->userRepository->where('id', $material->user_id)->get();

        return view('admin::materials.edit', compact('material', 'products', 'users'));
    }

    public function view($id)
    {
        $material = $this->materialRepository->findOrFail($id);
        $products = $this->materialProductRepository->where('material_id', $material->id)->get();
        $users = $this->userRepository->where('id', $material->user_id)->get();

        return view('admin::materials.show', compact('material', 'products', 'users'));
    }

    public function store()
    {
        $this->validate(request(), [
            'date'              => 'required',
            'qc_insp_req_no'    => 'nullable|unique:materials',
            'inspection_method' => 'nullable',
            'finish_status'     => 'nullable',
        ]);

        $data = request()->all();

        $material = $this->materialRepository->create($data);
        $material->save();

        if (isset($data['products'])) {
            foreach ($data['products'] as $product) {
                $materialProdData = $this->materialProductRepository->create(array_merge($product, [
                    'amount'        => $product['price'] * $product['quantity'],
                    'name'          => $product['name'],
                    'quantity'      => $product['quantity'],
                    'price'         => $product['price'],
                    'material_id'   => $material->id
                ]));
            }

            $materialProdData->save();
        }

        session()->flash('success', trans('admin::app.materials.create-success'));

        return redirect()->route('admin.materials.index');
    }

    public function update(Request $request, $id)
    {
        $data = request()->all();

        $material = $this->materialRepository->update([
            'date'              => request('date'),
            'qc_insp_req_no'    => request('qc_insp_req_no'),
            'inspection_method' => request('inspection_method'),
            'finish_status'     => request('finish_status'),
            'approved'          => request('approved'),
            'user_id'           => request('user_id')
        ], $id);

        if (request('approved') == 1) {
            $approved = $this->materialRepository->update([
                'approved_date'     => Carbon::now(),
                'approved_by'       => session('login_user_59ba36addc2b2f9401580f014c7f58ea4e30989d')
            ], $id);
        }

        if (isset($data['products'])) {
            foreach ($data['products'] as $productId => $product) {
                $materialProdData = $this->materialProductRepository->create(array_merge($product, [
                    'amount'        => $product['price'] * $product['quantity'],
                    'name'          => $product['name'],
                    'quantity'      => $product['quantity'],
                    'price'         => $product['price'],
                    'material_id'   => $material->id
                ]));
            }
            $materialProdData->save();
        }

        session()->flash('success', trans('admin::app.materials.update-success'));

        return redirect()->route('admin.materials.index');
    }

    public function search()
    {
        $results = $this->materialRepository->findWhere([
            ['qc_insp_req_no', 'like', '%' . urldecode(request()->input('query')) . '%']
        ]);

        return response()->json($results);
    }

    public function destroy($id)
    {
        $this->materialRepository->findOrFail($id);

        try {

            $this->materialRepository->delete($id);

            return response()->json([
                'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.materials.title')]),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.materials.title')]),
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
        foreach (request('rows') as $materialId) {
            $this->materialRepository->delete($materialId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.materials.title')]),
        ]);
    }

    public function print($id)
    {
        $material = $this->materialRepository->findOrFail($id);
        $products = $this->materialProductRepository->where('material_id', $material->id)->get();

        return PDF::loadHTML(view('admin::materials.pdf', compact('material', 'products'))->render())
            ->setPaper('a4')
            ->download('Material_Request_' . $material->qc_insp_req_no . '.pdf');
    }
}

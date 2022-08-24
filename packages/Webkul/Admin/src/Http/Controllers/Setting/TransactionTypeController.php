<?php

namespace Webkul\Admin\Http\Controllers\Setting;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;

use Webkul\Admin\DataGrids\Setting\TransactionTypeDataGrid;
use Webkul\Core\Repositories\TransactionTypeRepository;

use Barryvdh\DomPDF\Facade as PDF;

class TransactionTypeController extends Controller
{
    protected $transactionTypeRepository;

    public function __construct(TransactionTypeRepository $transactionTypeRepository)
    {
        $this->transactionTypeRepository = $transactionTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(TransactionTypeDataGrid::class)->toJson();
        }

        return view('admin::settings.transaction-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::settings.transaction-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'transaction_code'    => 'nullable',
            'transaction_name'    => 'nullable',
            'amount'              => 'nullable',
        ]);

        $data = request()->all();

        $transactionType = $this->transactionTypeRepository->create($data);
        $transactionType->save();

        session()->flash('success', trans('admin::app.transaction-types.create-success'));

        return redirect()->route('admin.settings.transaction-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $transactionType = $this->transactionTypeRepository->findOrFail($id);

        return view('admin::settings.transaction-types.edit', compact('transactionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeForm $request, $id)
    {
        Event::dispatch('admin.settings.transaction-types.update.before', $id);

        $transactionType = $this->transactionTypeRepository->update(request()->all(), $id);

        Event::dispatch('admin.settings.transaction-types.update.after', $transactionType);

        session()->flash('success', trans('admin::app.transaction-types.update-success'));

        return redirect()->route('admin.settings.transaction-types.index');
    }

    public function search()
    {
        $results = $this->transactionTypeRepository->findWhere([
            ['transaction_name', 'like', '%' . urldecode(request()->input('query')) . '%']
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
        $this->transactionTypeRepository->findOrFail($id);

        try {
            Event::dispatch('admin.settings.transaction-types.before', $id);

            $this->transactionTypeRepository->delete($id);

            Event::dispatch('admin.settings.transaction-types.after', $id);

            return response()->json([
                'message' => trans('admin::app.transaction-types.destroy-success', ['name' => trans('admin::app.transaction-types.title')]),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.transaction-types.destroy-failed', ['name' => trans('admin::app.transaction-types.title')]),
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
        foreach (request('rows') as $transactionTypeId) {
            Event::dispatch('admin.settings.transaction-types.before', $transactionTypeId);

            $this->transactionTypeRepository->delete($transactionTypeId);

            Event::dispatch('admin.settings.transaction-types.after', $transactionTypeId);
        }

        return response()->json([
            'message' => trans('admin::app.transaction-types.destroy-success', ['name' => trans('admin::app.transaction-types.title')]),
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
        $transactionType = $this->transactionTypeRepository->findOrFail($id);

        return PDF::loadHTML(view('admin::settings.transaction-types.pdf', compact('transactionType'))->render())
            ->setPaper('a4')
            ->download('transactionType_' . $transactionType->subject . '.pdf');
    }
}

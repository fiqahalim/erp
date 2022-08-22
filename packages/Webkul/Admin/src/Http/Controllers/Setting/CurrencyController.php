<?php

namespace Webkul\Admin\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use Webkul\Core\Repositories\CurrencyRepository;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Setting\CurrencyDataGrid;

class CurrencyController extends Controller
{
    protected $currencyRepository;

    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(CurrencyDataGrid::class)->toJson();
        }

        return view('admin::settings.currencies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::settings.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'currency_name'    => 'required',
            'fx_rate'          => 'nullable',
        ]);

        $data = request()->all();

        $data['status'] = isset($data['status']) ? 1 : 0;

        $currency = $this->currencyRepository->create($data);
        $currency->save();

        session()->flash('success', trans('admin::app.currencies.create-success'));

        return redirect()->route('admin.settings.currencies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $currency = $this->currencyRepository->findOrFail($id);

        return view('admin::settings.currencies.edit', compact('currency'));
    }

    public function update(Request $request, $id)
    {
        Event::dispatch('admin.settings.currencies.update.before', $id);

        $currency = $this->currencyRepository->update(request()->all(), $id);

        Event::dispatch('admin.settings.currencies.update.after', $currency);

        session()->flash('success', trans('admin::app.currencies.update-success'));

        return redirect()->route('admin.settings.currencies.index');
    }

    public function search()
    {
        $results = $this->currencyRepository->findWhere([
            ['currency_name', 'like', '%' . urldecode(request()->input('query')) . '%']
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
        $this->currencyRepository->findOrFail($id);

        try {
            Event::dispatch('admin.settings.currencies.before', $id);

            $this->currencyRepository->delete($id);

            Event::dispatch('admin.settings.currencies.after', $id);

            return response()->json([
                'message' => trans('admin::app.currencies.delete-success', ['name' => trans('admin::app.currencies.quote')]),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.currencies.delete-failed', ['name' => trans('admin::app.currencies.quote')]),
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
        foreach (request('rows') as $currencyId) {
            Event::dispatch('admin.settings.currencies.before', $currencyId);

            $this->currencyRepository->delete($currencyId);

            Event::dispatch('admin.settings.currencies.after', $currencyId);
        }

        return response()->json([
            'message' => trans('admin::app.currencies.delete-success', ['name' => trans('admin::app.currencies.title')]),
        ]);
    }
}

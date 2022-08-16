<?php

namespace Webkul\Admin\Http\Controllers\Setting;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;
use Webkul\Core\Repositories\LocationRepository;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Admin\DataGrids\Setting\LocationDataGrid;
use Webkul\Attribute\Http\Requests\AttributeForm;

use Barryvdh\DomPDF\Facade as PDF;

class LocationController extends Controller
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(LocationDataGrid::class)->toJson();
        }

        return view('admin::settings.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::settings.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'location_code'    => 'required',
            'location_name'    => 'nullable',
            'type'             => 'nullable',
        ]);

        $data = request()->all();

        $data['status'] = isset($data['status']) ? 1 : 0;

        $currency = $this->locationRepository->create($data);
        $currency->save();

        session()->flash('success', trans('admin::app.locations.create-success'));

        return redirect()->route('admin.settings.locations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $location = $this->locationRepository->findOrFail($id);

        return view('admin::settings.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeForm $request, $id)
    {
        Event::dispatch('admin.settings.locations.update.before', $id);

        $location = $this->locationRepository->update(request()->all(), $id);

        Event::dispatch('admin.settings.locations.update.after', $location);

        session()->flash('success', trans('admin::app.locations.update-success'));

        return redirect()->route('admin.settings.locations.index');
    }

    public function search()
    {
        $results = $this->locationRepository->findWhere([
            ['location_name', 'like', '%' . urldecode(request()->input('query')) . '%']
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
        $this->locationRepository->findOrFail($id);

        try {
            Event::dispatch('admin.settings.locations.before', $id);

            $this->locationRepository->delete($id);

            Event::dispatch('admin.settings.locations.after', $id);

            return response()->json([
                'message' => trans('admin::app.locations.destroy-success', ['name' => trans('admin::app.locations.quote')]),
            ], 200);
        } catch(\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.locations.destroy-failed', ['name' => trans('admin::app.locations.quote')]),
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
        foreach (request('rows') as $locationId) {
            Event::dispatch('admin.settings.locations.before', $locationId);

            $this->locationRepository->delete($locationId);

            Event::dispatch('admin.settings.locations.after', $locationId);
        }

        return response()->json([
            'message' => trans('admin::app.locations.destroy-success', ['name' => trans('admin::app.locations.title')]),
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
        $location = $this->locationRepository->findOrFail($id);

        return PDF::loadHTML(view('admin::settings.locations.pdf', compact('location'))->render())
            ->setPaper('a4')
            ->download('Location_' . $location->subject . '.pdf');
    }
}

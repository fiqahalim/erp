<?php

namespace Webkul\Admin\Http\Controllers\Contact;

use Illuminate\Support\Facades\Event;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Attribute\Http\Requests\AttributeForm;
use Webkul\Contact\Repositories\PersonRepository;

class PersonController extends Controller
{
    /**
     * Person repository instance.
     *
     * @var \Webkul\Contact\Repositories\PersonRepository
     */
    protected $personRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Webkul\Contact\Repositories\PersonRepository  $personRepository
     *
     * @return void
     */
    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;

        request()->request->add(['entity_type' => 'persons']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Admin\DataGrids\Contact\PersonDataGrid::class)->toJson();
        }

        return view('admin::contacts.persons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin::contacts.persons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Webkul\Attribute\Http\Requests\AttributeForm $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeForm $request)
    {
        Event::dispatch('contacts.person.create.before');

        $person = $this->personRepository->create($this->sanitizeRequestedPersonData());

        Event::dispatch('contacts.person.create.after', $person);

        session()->flash('success', trans('admin::app.contacts.persons.create-success'));

        return redirect()->route('admin.contacts.persons.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $person = $this->personRepository->findOrFail($id);

        return view('admin::contacts.persons.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Webkul\Attribute\Http\Requests\AttributeForm $request
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeForm $request, $id)
    {
        Event::dispatch('contacts.person.update.before', $id);

        $person = $this->personRepository->update($this->sanitizeRequestedPersonData(), $id);

        Event::dispatch('contacts.person.update.after', $person);

        session()->flash('success', trans('admin::app.contacts.persons.update-success'));

        return redirect()->route('admin.contacts.persons.index');
    }

    public function view($id)
    {
        $person = $this->personRepository->findOrFail($id);

        $arrayMobile = isset($person->contact_numbers) ? $person->contact_numbers : [];
        $arrayPhone = isset($person->phone_numbers) ? $person->phone_numbers : [];
        $arrayFax = isset($person->fax_numbers) ? $person->fax_numbers : [];
        $arrayEmail = isset($person->emails) ? $person->emails : [];
        $arrayAddress = isset($person->address_1) ? $person->address_1 : [];

        $mobile = $phone = $fax = $email = '';

        $perAddr = array(
                $arrayAddress['address'],
                $arrayAddress['postcode'],
                $arrayAddress['city'],
                $arrayAddress['state'],
                $arrayAddress['country'],
            );

        $address = implode(", ", $perAddr);

        foreach ($arrayMobile as $value) {
            $mobile = $value['value'];
        }

        foreach ($arrayPhone as $value) {
            $phone = $value['value'];
        }

        foreach ($arrayFax as $value) {
            $fax = $value['value'];
        }

        foreach ($arrayEmail as $value) {
            $email = $value['value'];
        }

        $currentUser = auth()->guard('user')->user();

        if ($currentUser->view_permission != 'global') {
            if ($currentUser->view_permission == 'group') {
                $userIds = app('\Webkul\User\Repositories\UserRepository')->getCurrentUserGroupsUserIds();

                if (! in_array($person->user_id, $userIds)) {
                    return redirect()->route('admin.contacts.persons.index');
                }
            } else {
                if ($person->user_id != $currentUser->id) {
                    return redirect()->route('admin.contacts.persons.index');
                }
            }
        }

        return view('admin::contacts.persons.show', compact('person', 'mobile', 'phone', 'fax', 'email', 'address'));
    }

    /**
     * Search person results.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $results = $this->personRepository->findWhere([
            ['name', 'like', '%' . urldecode(request()->input('query')) . '%']
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
        $person = $this->personRepository->findOrFail($id);

        try {
            Event::dispatch('contacts.person.delete.before', $id);

            $this->personRepository->delete($id);

            Event::dispatch('contacts.person.delete.after', $id);

            return response()->json([
                'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.contacts.persons.person')]),
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'message' => trans('admin::app.response.destroy-failed', ['name' => trans('admin::app.contacts.persons.person')]),
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
        foreach (request('rows') as $personId) {
            Event::dispatch('contact.person.delete.before', $personId);

            $this->personRepository->delete($personId);

            Event::dispatch('contact.person.delete.after', $personId);
        }

        return response()->json([
            'message' => trans('admin::app.response.destroy-success', ['name' => trans('admin::app.contacts.persons.title')])
        ]);
    }

    /**
     * Sanitize requested person data and return the clean array.
     *
     * @return array
     */
    private function sanitizeRequestedPersonData(): array
    {
        $data = request()->all();

        $data['contact_numbers'] = collect($data['contact_numbers'])->filter(function ($number) {
            return ! is_null($number['value']);
        })->toArray();

        return $data;
    }
}

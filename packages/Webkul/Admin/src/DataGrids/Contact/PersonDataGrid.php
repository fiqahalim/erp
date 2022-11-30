<?php

namespace Webkul\Admin\DataGrids\Contact;

use Illuminate\Support\Facades\DB;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\UI\DataGrid\DataGrid;

class PersonDataGrid extends DataGrid
{
    use ProvideDropdownOptions;

    /**
     * Export option.
     *
     * @var boolean
     */
    protected $export;

    /**
     * Create datagrid instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->export = bouncer()->hasPermission('contacts.persons.export') ? true : false;
    }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('persons')
            ->addSelect(
                'persons.id',
                'persons.code',
                'persons.name as company_name',
                'persons.pic_name',
                'persons.department',
                'persons.emails',
                'persons.contact_numbers',
                'persons.business_type',
                'persons.bank_name',
                'persons.account_no',
                'persons.account_holder',
                'persons.vendor_status',
                // 'organizations.name as organization'
            );
            // ->leftJoin('organizations', 'persons.organization_id', '=', 'organizations.id');

        $this->addFilter('id', 'persons.id');
        $this->addFilter('company_name', 'persons.name');
        $this->addFilter('emails', 'persons.emails');
        // $this->addFilter('organization', 'organizations.id');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'    => 'code',
            'label'    => trans('admin::app.contacts.persons.code'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'company_name',
            'label'    => trans('admin::app.contacts.persons.name'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'pic_name',
            'label'    => trans('admin::app.contacts.persons.ceo_name'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'emails',
            'label'    => trans('admin::app.datagrid.emails'),
            'type'     => 'string',
            'sortable' => false,
            'closure'  => function ($row) {
                $emails = json_decode($row->emails, true);

                if ($emails) {
                    return collect($emails)->pluck('value')->join(', ');
                }
            },
        ]);

        $this->addColumn([
            'index'    => 'contact_numbers',
            'label'    => trans('admin::app.datagrid.contact_numbers'),
            'type'     => 'string',
            'sortable' => false,
            'closure'  => function ($row) {
                $contactNumbers = json_decode($row->contact_numbers, true);

                if ($contactNumbers) {
                    return collect($contactNumbers)->pluck('value')->join(', ');
                }
            },
        ]);

        $this->addColumn([
            'index'    => 'business_type',
            'label'    => trans('admin::app.contacts.persons.business_type'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'bank_name',
            'label'    => trans('admin::app.contacts.persons.bank_name'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'account_no',
            'label'    => trans('admin::app.contacts.persons.account_no'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'account_holder',
            'label'    => trans('admin::app.contacts.persons.account_holder'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'            => 'vendor_status',
            'label'            => trans('admin::app.contacts.persons.vendor_status'),
            'type'             => 'string',
            'searchable'       => false,
            'closure'          => function ($row) {
                if ($row->vendor_status == 1) {
                    return trans('admin::app.contacts.persons.approved');
                } elseif ($row->vendor_status == 2) {
                    return trans('admin::app.contacts.persons.pending');
                } else {
                    return trans('admin::app.contacts.persons.reject');
                }
            },
            
        ]);

        // $this->addColumn([
        //     'index'            => 'organization',
        //     'label'            => trans('admin::app.datagrid.organization_name'),
        //     'type'             => 'dropdown',
        //     'dropdown_options' => $this->getOrganizationDropdownOptions(),
        //     'sortable'         => false,
        // ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.contacts.persons.view',
            'icon'   => 'eye-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.contacts.persons.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.contacts.persons.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => trans('admin::app.contacts.persons.person')]),
            'icon'         => 'trash-icon',
        ]);
    }

    /**
     * Prepare mass actions.
     *
     * @return void
     */
    public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'label'  => trans('ui::app.datagrid.delete'),
            'action' => route('admin.contacts.persons.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}

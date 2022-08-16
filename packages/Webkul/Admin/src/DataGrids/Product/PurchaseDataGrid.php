<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class PurchaseDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('purchases')
            ->addSelect(
                'purchases.id',
                'purchases.purchase_no',
                'purchases.date',
                'users.id as user_id',
                'users.name as sales_person',
                'persons.id as person_id',
                'persons.name as person_name',
            )
            ->leftJoin('users', 'purchases.user_id', '=', 'users.id')
            ->leftJoin('persons', 'purchases.person_id', '=', 'persons.id');

        $this->addFilter('user', 'purchases.user_id');
        $this->addFilter('sales_person', 'purchases.user_id');
        $this->addFilter('person_name', 'persons.name');
        $this->addFilter('id', 'purchases.id');

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
            'index'    => 'id',
            'label'    => trans('admin::app.datagrid.id'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'date',
            'label'    => trans('admin::app.purchases.date'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'purchase_no',
            'label'    => trans('admin::app.purchases.purchase_no'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'      => 'person_name',
            'label'      => trans('admin::app.contacts.persons.title'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => false,
        ]);

        $this->addColumn([
            'index'      => 'sales_person',
            'label'      => trans('admin::app.settings.users.title'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => false,
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.purchases.edit',
            'icon'   => 'eye-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.purchases.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.purchases.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'user']),
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
            'action' => route('admin.purchases.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}

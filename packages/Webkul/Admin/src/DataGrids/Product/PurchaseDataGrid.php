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
                'purchases.delivery_date',
                'purchases.expired_date',
                'purchases.purchase_no',
                'purchases.progress_status',
                'purchases.approved',
                'purchases.approved_date',
                'users.id as user_id',
                'users.name as sales_person',
                'purchase_items.id as purchase_items_id',
                'purchase_items.name as purchase_items_name',
                'purchase_items.amount as purchase_items_amount',
            )
            ->leftJoin('users', 'purchases.user_id', '=', 'users.id')
            ->leftJoin('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.id');

        $this->addFilter('id', 'purchases.id');
        $this->addFilter('user', 'purchases.user_id');
        $this->addFilter('sales_person', 'purchases.user_id');

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
            'index'      => 'delivery_date',
            'label'      => trans('admin::app.purchases.delivery_date'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->delivery_date);
            },
        ]);

        $this->addColumn([
            'index'      => 'expired_date',
            'label'      => trans('admin::app.purchases.expired_date'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->expired_date);
            },
        ]);

        $this->addColumn([
            'index'    => 'purchase_no',
            'label'    => trans('admin::app.purchases.purchase_no'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'      => 'sales_person',
            'label'      => trans('admin::app.settings.users.title'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => false,
        ]);

        $this->addColumn([
            'index'      => 'purchase_items_name',
            'label'      => trans('admin::app.products.item_name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'purchase_items_amount',
            'label'      => trans('admin::app.purchases.amount'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'closure'  => function ($row) {
                return number_format($row->purchase_items_amount, 2);
            },
        ]);

        $this->addColumn([
            'index'      => 'progress_status',
            'label'      => trans('admin::app.purchases.progress_status'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => false,
        ]);

        $this->addColumn([
            'index'            => 'approved',
            'label'            => trans('admin::app.purchases.approved'),
            'type'             => 'string',
            'searchable'       => false,
            'closure'          => function ($row) {
                if ($row->approved == 1) {
                    return '<span class="badge badge-round badge-primary"></span>' . trans('admin::app.purchases.approved');
                } else {
                    return '<span class="badge badge-round badge-danger"></span>' . trans('admin::app.purchases.not_approved');
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'approved_date',
            'label'      => trans('admin::app.purchases.approved_date'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->approved_date);
            },
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
            'title'  => trans('ui::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.purchases.view',
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

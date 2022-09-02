<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class PurchaseOrderDataGrid extends DataGrid
{
    protected $export;

    public function __construct()
    {
        parent::__construct();

        $this->export = bouncer()->hasPermission('purchases-orders.export') ? true : false;
    }

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('purchase_orders')
            ->addSelect(
                'purchase_orders.id',
                'purchase_orders.delivery_date',
                'purchase_orders.expired_date',
                'purchase_orders.purchase_no',
                'purchase_orders.progress_status',
                'purchase_orders.approved',
                'purchase_orders.approved_date',
                'users.id as user_id',
                'users.name as sales_person',
                'purchase_order_items.id as purchase_order_items_id',
                'purchase_order_items.name as purchase_order_items_name',
                'purchase_order_items.amount as purchase_order_items_amount',
            )
            ->leftJoin('users', 'purchase_orders.user_id', '=', 'users.id')
            ->leftJoin('purchase_order_items', 'purchase_order_items.purchase_order_id', '=', 'purchase_orders.id');

        $this->addFilter('id', 'purchase_orders.id');
        $this->addFilter('user', 'purchase_orders.user_id');
        $this->addFilter('sales_person', 'purchase_orders.user_id');

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
            'index'      => 'purchase_order_items_name',
            'label'      => trans('admin::app.products.item_name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'purchase_order_items_amount',
            'label'      => trans('admin::app.purchases.amount'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'closure'  => function ($row) {
                return number_format($row->purchase_order_items_amount, 2);
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
            'route'  => 'admin.purchases-orders.view',
            'icon'   => 'eye-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.purchases-orders.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.purchases-orders.delete',
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
            'action' => route('admin.purchases-orders.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}

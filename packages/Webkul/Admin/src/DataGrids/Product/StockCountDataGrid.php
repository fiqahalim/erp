<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class StockCountDataGrid extends DataGrid
{
    protected $export;

    public function __construct()
    {
        parent::__construct();

        $this->export = bouncer()->hasPermission('stocks.export') ? true : false;
    }

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('purchase_orders')
            ->addSelect(
                'purchase_orders.id',
                'purchase_orders.expired_date',
                'purchase_orders.purchase_no',
                'users.id as user_id',
                'users.name as sales_person',
                'purchase_order_items.id as purchase_order_items_id',
                'purchase_order_items.sku as purchase_order_items_sku',
                'purchase_order_items.name as purchase_order_items_name',
                'purchase_order_items.spec as purchase_order_items_spec',
                'purchase_order_items.quantity as purchase_order_items_quantity',
                'products.id as product_id',
                'products.unit as products_unit',
            )
            ->leftJoin('users', 'purchase_orders.user_id', '=', 'users.id')
            ->leftJoin('purchase_order_items', 'purchase_order_items.purchase_order_id', '=', 'purchase_orders.id')
            ->leftJoin('products', 'purchase_order_items.product_id', '=', 'products.id');

        $this->addFilter('id', 'purchase_orders.id');
        $this->addFilter('user', 'purchase_orders.user_id');
        $this->addFilter('sales_person', 'purchase_orders.user_id');
        $this->addFilter('products_unit', 'purchase_order_items.user_id');

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
            'index'      => 'purchase_order_items_sku',
            'label'      => trans('admin::app.products.item_code'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'purchase_order_items_name',
            'label'      => trans('admin::app.products.item_name'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'purchase_order_items_spec',
            'label'      => trans('admin::app.products.spec'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'products_unit',
            'label'      => trans('admin::app.products.unit'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'purchase_order_items_quantity',
            'label'      => trans('Current Unit Quantity'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        // $this->addColumn([
        //     'index'    => 'purchase_no',
        //     'label'    => trans('admin::app.purchases.purchase_no'),
        //     'type'     => 'string',
        //     'sortable' => true,
        //     'searchable' => true,
        // ]);

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

        // $this->addColumn([
        //     'index'      => 'sales_person',
        //     'label'      => trans('admin::app.settings.users.title'),
        //     'type'       => 'string',
        //     'searchable' => false,
        //     'sortable'   => false,
        // ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    // public function prepareActions()
    // {
    //     $this->addAction([
    //         'title'  => trans('ui::app.datagrid.view'),
    //         'method' => 'GET',
    //         'route'  => 'admin.purchases-orders.view',
    //         'icon'   => 'eye-icon',
    //     ]);

    //     $this->addAction([
    //         'title'  => trans('ui::app.datagrid.edit'),
    //         'method' => 'GET',
    //         'route'  => 'admin.purchases-orders.edit',
    //         'icon'   => 'pencil-icon',
    //     ]);

    //     $this->addAction([
    //         'title'        => trans('ui::app.datagrid.delete'),
    //         'method'       => 'DELETE',
    //         'route'        => 'admin.purchases-orders.delete',
    //         'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'user']),
    //         'icon'         => 'trash-icon',
    //     ]);
    // }

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

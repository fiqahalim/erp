<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;

class IncomingStockDataGrid extends DataGrid
{
    protected $export;

    public function __construct()
    {
        parent::__construct();

        $this->export = bouncer()->hasPermission('stocks.export') ? true : false;
    }

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('incoming_stocks')
            ->addSelect(
                'incoming_stocks.id',
                'incoming_stocks.purchasing_organization',
                'incoming_stocks.23_material_no',
                'incoming_stocks.quantity_receive',
                'incoming_stocks.quantity_unreceive',
                'incoming_stocks.spec',
                'incoming_stocks.coa_msds',
                'incoming_stocks.remarks',
                'incoming_stocks.receive_date',
                'incoming_stocks.expiry_date',
                'incoming_stocks.actual_receive_date',
                'incoming_stocks.manufacture_date',
                'incoming_stocks.status',
                'persons.id as person_id',
                'persons.name as sales_person',
                // 'purchase_orders.id as purchase_order_id',
                // 'purchase_orders.purchase_no as purchase__orders_purchase_no',
                // 'purchase_orders.created_at as purchase_orders_created_at',
                // 'products.id as product_id',
                // 'products.sku as products_sku',
                // 'products.name as products_name',
                // 'products.spec as products_spec',
                // 'products.spec as products_spec',
                // 'products.unit as products_unit',
            )
            ->leftJoin('persons', 'incoming_stocks.person_id', '=', 'persons.id');
            // ->leftJoin('purchase_order_items', 'purchase_order_items.purchase_order_id', '=', 'purchase_orders.id')
            // ->leftJoin('products', 'purchase_order_items.product_id', '=', 'products.id');

        $this->addFilter('id', 'incoming_stocks.id');
        $this->addFilter('persons', 'incoming_stocks.person_id');
        // $this->addFilter('sales_person', 'purchase_orders.user_id');
        // $this->addFilter('products_unit', 'purchase_order_items.user_id');

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
            'index'      => 'purchase_order_items_description',
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
            'label'      => trans('admin::app.purchases.quantity_order'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'    => 'purchase_no',
            'label'    => trans('admin::app.purchases.purchase_no'),
            'type'     => 'string',
            'sortable' => true,
            'searchable' => true,
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

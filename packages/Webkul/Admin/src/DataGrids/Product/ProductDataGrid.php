<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Illuminate\Support\Facades\Storage;

class ProductDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('products')
            ->addSelect(
                'products.id',
                'products.sku',
                'products.name',
                'products.unit',
                'products.description',
                'products.additional_spec',
                'products.quantity',
                'products.lead_time',
                'products.shelf_life',
                'products.item_category',
                'products.status',
                // 'products.price',
                // 'products.sale_price',
                'persons.id as person_id',
                'persons.code as person_name',
            )
            ->leftJoin('persons', 'products.person_id', '=', 'persons.id');

        $this->addFilter('id', 'products.id');
        $this->addFilter('person_name', 'persons.name');

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
            'index'    => 'sku',
            'label'    => trans('admin::app.products.item_code'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'name',
            'label'    => trans('admin::app.products.item_name'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'unit',
            'label'    => trans('admin::app.products.unit'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'description',
            'label'    => trans('admin::app.products.spec'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'    => 'additional_spec',
            'label'    => trans('admin::app.products.additional_spec'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        // $this->addColumn([
        //     'index'    => 'price',
        //     'label'    => trans('admin::app.products.purchase_price'),
        //     'type'     => 'string',
        //     'sortable' => true,
        //     'closure'  => function ($row) {
        //         return round($row->price, 2);
        //     },
        // ]);

        // $this->addColumn([
        //     'index'    => 'sale_price',
        //     'label'    => trans('admin::app.products.sale_price'),
        //     'type'     => 'string',
        //     'sortable' => true,
        //     'closure'  => function ($row) {
        //         return round($row->sale_price, 2);
        //     },
        // ]);

        $this->addColumn([
            'index'    => 'quantity',
            'label'    => trans('admin::app.products.quantity'),
            'type'     => 'string',
            'sortable' => true,
        ]);

        $this->addColumn([
            'index'      => 'lead_time',
            'label'      => trans('admin::app.products.lead_time'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->lead_time);
            },
        ]);

        $this->addColumn([
            'index'      => 'shelf_life',
            'label'      => trans('admin::app.products.shelf_life'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                return core()->formatDate($row->shelf_life);
            },
        ]);

        $this->addColumn([
            'index'      => 'person',
            'label'      => trans('admin::app.contacts.persons.code'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => false,
            'closure'    => function ($row) {
                $route = urldecode(route('admin.contacts.persons.index', ['id[eq]' => $row->person_id]));

                return "<a href='" . $route . "'>" . $row->person_name . "</a>";
            },
        ]);

        $this->addColumn([
            'index'    => 'item_category',
            'label'    => trans('admin::app.products.item_category'),
            'type'     => 'string',
            'sortable' => false,
        ]);

        $this->addColumn([
            'index'            => 'status',
            'label'            => trans('admin::app.products.status'),
            'type'             => 'string',
            'searchable'       => false,
            'closure'          => function ($row) {
                if ($row->status == 1) {
                    return '<span class="badge badge-round badge-primary"></span>' . trans('admin::app.datagrid.active');
                } else {
                    return '<span class="badge badge-round badge-danger"></span>' . trans('admin::app.datagrid.inactive');
                }
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
            'route'  => 'admin.products.view',
            'icon'   => 'eye-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.products.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.products.delete',
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
            'action' => route('admin.products.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}

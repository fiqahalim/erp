<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Illuminate\Support\Facades\Storage;

use Webkul\User\Repositories\UserRepository;

class StockCountDataGrid extends DataGrid
{
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('stocks')
            ->addSelect(
                'stocks.id',
                'stocks.expired_at',
                'stocks.current_stock',
                // 'users.id as user_id',
                // 'users.name as pic_name',
                // 'material_products.id as material_prod_id',
                // 'material_products.name as material_prod_name',
                // 'material_products.quantity as material_prod_quantity',
            );
            // ->leftJoin('users', 'materials.user_id', '=', 'users.id')
            // ->leftJoin('material_products', 'material_products.material_id', '=', 'materials.id');

        $this->addFilter('expired_at', 'stocks.expired_at');
        $this->addFilter('user', 'materials.user_id');
        $this->addFilter('pic_name', 'materials.user_id');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'string',
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'expired_at',
            'label'      => trans('admin::app.stocks.expired_at'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                if (! $row->expired_at) {
                    return '--';
                }
                return core()->formatDate($row->expired_at);
            },
        ]);

        $this->addColumn([
            'index'      => 'current_stock',
            'label'      => trans('admin::app.stocks.current_stock'),
            'type'       => 'string',
            'sortable'   => true,
            'searchable' => false,
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('ui::app.datagrid.download'),
            'method' => 'GET',
            'route'  => 'admin.stocks.print',
            'icon'   => 'export-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.view'),
            'method' => 'GET',
            'route'  => 'admin.stocks.view',
            'icon'   => 'eye-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.stocks.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.stocks.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => trans('admin::app.stocks.title')]),
            'icon'         => 'trash-icon',
        ]);
    }
}

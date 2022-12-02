<?php

namespace Webkul\Admin\DataGrids\Product;

use Webkul\UI\DataGrid\DataGrid;
use Illuminate\Support\Facades\DB;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Illuminate\Support\Facades\Storage;

use Webkul\User\Repositories\UserRepository;

class MaterialDataGrid extends DataGrid
{
    /**
     * Export option.
     *
     * @var boolean
     */
    protected $export;

    protected $userRepository;

    /**
     * Create datagrid instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();

        $this->export = bouncer()->hasPermission('materials.export') ? true : false;
    }

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('materials')
            ->addSelect(
                'materials.id',
                'materials.date',
                'materials.status',
                // 'materials.approved',
                'materials.created_at',
                'users.id as user_id',
                'users.name as pic_name',
                'material_products.id as material_prod_id',
                'material_products.sku as material_prod_sku',
                'material_products.name as material_prod_name',
                'material_products.quantity as material_prod_quantity',
                'material_products.stock_balance as material_prod_stock_balance',
            )
            ->leftJoin('users', 'materials.user_id', '=', 'users.id')
            // ->leftJoin('users', 'materials.approved_by', '=', 'users.id')
            ->leftJoin('material_products', 'material_products.material_id', '=', 'materials.id');

        $this->addFilter('id', 'materials.id');
        $this->addFilter('user', 'materials.user_id');
        $this->addFilter('pic_name', 'materials.user_id');

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
            'index'      => 'date',
            'label'      => trans('admin::app.materials.date'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                if (! $row->date) {
                    return '--';
                }
                return core()->formatDate($row->date);
            },
        ]);

        $this->addColumn([
            'index'            => 'pic_name',
            'label'            => trans('admin::app.materials.department_pic'),
            'type'             => 'string',
            'searchable'       => false,
            'sortable'         => true,
            'closure'          => function ($row) {
                $route = urldecode(route('admin.settings.users.index', ['id[eq]' => $row->user_id]));

                return "<a href='" . $route . "'>" . $row->pic_name . "</a>";
            },
        ]);

        $this->addColumn([
            'index'      => 'material_prod_name',
            'label'      => trans('admin::app.products.item_name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'material_prod_quantity',
            'label'      => trans('admin::app.materials.requested_units'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'material_prod_stock_balance',
            'label'      => trans('admin::app.materials.stock_balance'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.materials.status'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
        ]);

        // $this->addColumn([
        //     'index'            => 'approved',
        //     'label'            => trans('admin::app.purchases.approved'),
        //     'type'             => 'string',
        //     'searchable'       => false,
        //     'closure'          => function ($row) {
        //         if ($row->approved == 1) {
        //             return '<span class="badge badge-round badge-primary"></span>' . trans('admin::app.purchases.approved');
        //         } else {
        //             return '<span class="badge badge-round badge-danger"></span>' . trans('admin::app.purchases.not_approved');
        //         }
        //     },
        // ]);

        $this->addColumn([
            'index'      => 'created_at',
            'label'      => trans('admin::app.materials.approval_slip_date'),
            'type'       => 'date_range',
            'searchable' => false,
            'sortable'   => true,
            'closure'    => function ($row) {
                if (! $row->created_at) {
                    return '--';
                }
                return core()->formatDate($row->created_at);
            },
        ]);

        $this->addColumn([
            'index'            => 'pic_name',
            'label'            => trans('admin::app.materials.approver'),
            'type'             => 'string',
            'searchable'       => false,
            'sortable'         => true,
            'closure'          => function ($row) {
                return $row->pic_name;
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
            'route'  => 'admin.materials.view',
            'icon'   => 'eye-icon',
        ]);

        $this->addAction([
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.materials.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.materials.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => trans('admin::app.materials.title')]),
            'icon'         => 'trash-icon',
        ]);
    }
}

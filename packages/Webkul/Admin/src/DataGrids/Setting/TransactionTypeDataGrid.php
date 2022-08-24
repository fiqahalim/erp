<?php

namespace Webkul\Admin\DataGrids\Setting;

use Webkul\Admin\Traits\ProvideDropdownOptions;
use Illuminate\Support\Facades\DB;
use Webkul\UI\DataGrid\DataGrid;

class TransactionTypeDataGrid extends DataGrid
{
    use ProvideDropdownOptions;

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('transaction_types')
            ->addSelect(
                'transaction_types.id',
                'transaction_types.transaction_name',
                // 'transaction_types.transaction_code',
                // 'transaction_types.amount',
            );

        $this->addFilter('id', 'transaction_types.id');

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Add columns.
     *
     * @return void
     */
    public function addColumns()
    {
        // $this->addColumn([
        //     'index'      => 'transaction_code',
        //     'label'      => trans('admin::app.transaction_types.transaction_code'),
        //     'type'       => 'string',
        //     'searchable' => false,
        //     'sortable'   => true,
        // ]);

        $this->addColumn([
            'index'      => 'transaction_name',
            'label'      => trans('admin::app.transaction_types.transaction_name'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        // $this->addColumn([
        //     'index'    => 'amount',
        //     'label'      => trans('admin::app.transaction_types.amount'),
        //     'type'     => 'string',
        //     'sortable' => true,
        //     'closure'  => function ($row) {
        //         return number_format($row->amount, 2);
        //     },
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
            'title'  => trans('ui::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.settings.transaction_types.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.settings.transaction_types.delete',
            'confirm_text' => trans('ui::app.datagrid.massaction.delete', ['resource' => 'source']),
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
            'action' => route('admin.settings.transaction_types.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}

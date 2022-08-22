<?php

namespace Webkul\Admin\DataGrids\Setting;

use Webkul\Admin\Traits\ProvideDropdownOptions;
use Illuminate\Support\Facades\DB;
use Webkul\UI\DataGrid\DataGrid;

class CurrencyDataGrid extends DataGrid
{
    use ProvideDropdownOptions;

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('currencies')
            ->addSelect(
                'currencies.id',
                'currencies.currency_name',
                'currencies.fx_rate',
                'currencies.active',
            );

        $this->addFilter('id', 'currencies.id');

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
            'index'      => 'currency_name',
            'label'      => trans('admin::app.currencies.currency-name'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'fx_rate',
            'label'      => trans('admin::app.currencies.fx-rate'),
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
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
            'route'  => 'admin.settings.currencies.edit',
            'icon'   => 'pencil-icon',
        ]);

        $this->addAction([
            'title'        => trans('ui::app.datagrid.delete'),
            'method'       => 'DELETE',
            'route'        => 'admin.settings.currencies.delete',
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
            'action' => route('admin.settings.currencies.mass_delete'),
            'method' => 'PUT',
        ]);
    }
}

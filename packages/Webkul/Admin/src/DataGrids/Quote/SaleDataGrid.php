<?php

namespace Webkul\Admin\DataGrids\Quote;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Webkul\Admin\Traits\ProvideDropdownOptions;
use Webkul\UI\DataGrid\DataGrid;
use Webkul\Quote\Repositories\SaleRepository;

class SaleDataGrid extends DataGrid
{
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
}

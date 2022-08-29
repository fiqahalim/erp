<?php

namespace Webkul\Product\Repositories;

use Webkul\Core\Eloquent\Repository;

class StockRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Product\Contracts\Stock';
    }

    /**
     * Retrieves stock count based on date
     *
     * @return number
     */
    public function getStocksCount($startDate, $endDate)
    {
        return $this
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get()
                ->count();
    }
}

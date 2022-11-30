<?php

namespace Webkul\Quote\Repositories;

use Webkul\Core\Eloquent\Repository;

class SaleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Quote\Contracts\Sale';
    }
}
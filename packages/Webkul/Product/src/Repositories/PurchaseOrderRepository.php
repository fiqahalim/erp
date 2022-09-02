<?php

namespace Webkul\Product\Repositories;

use Webkul\Core\Eloquent\Repository;

class PurchaseOrderRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Product\Contracts\PurchaseOrder';
    }
}
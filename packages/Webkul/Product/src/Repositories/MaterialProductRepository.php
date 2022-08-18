<?php

namespace Webkul\Product\Repositories;

use Webkul\Core\Eloquent\Repository;

class MaterialProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Product\Contracts\MaterialProduct';
    }
}
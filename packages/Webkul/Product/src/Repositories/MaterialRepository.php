<?php

namespace Webkul\Product\Repositories;

use Webkul\Core\Eloquent\Repository;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Webkul\User\Repositories\UserRepository;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Product\Repositories\MaterialProductRepository;

class MaterialRepository extends Repository
{
    protected $userRepository, $productRepository;

    public function __construct(
        UserRepository $userRepository,
        ProductRepository $productRepository,
        Container $container
    ) {
        $this->userRepository = $userRepository;

        $this->productRepository = $productRepository;

        parent::__construct($container);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Product\Contracts\Material';
    }

    /**
     * Retrieves material request count based on date
     *
     * @return number
     */
    public function getMaterialsCount($startDate, $endDate)
    {
        return $this
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get()
                ->count();
    }
}

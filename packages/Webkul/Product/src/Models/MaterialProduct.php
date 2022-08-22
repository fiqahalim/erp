<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\ProductProxy;
use Webkul\Product\Models\MaterialProxy;
use Webkul\Product\Contracts\MaterialProduct as MaterialProductContract;

class MaterialProduct extends Model implements MaterialProductContract
{
    protected $table = 'material_products';

    protected $fillable = [
        'name', 'quantity', 'price', 'amount', 'material_id', 'sku', 'description', 'remarks',
        'product_id', 'created_at', 'updated_at',
    ];

    /**
     * Get the material that owns the material product.
     */
    public function material()
    {
        return $this->belongsTo(MaterialProxy::modelClass());
    }

    /**
     * Get the product owns the material product.
     */
    public function product()
    {
        return $this->belongsTo(ProductProxy::modelClass());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();

        $array['name'] = $this->name;

        return $array;
    }
}

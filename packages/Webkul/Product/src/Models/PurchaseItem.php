<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\PurchaseProxy;
use Webkul\Product\Models\ProductProxy;
use Webkul\Product\Contracts\PurchaseItem as PurchaseItemContract;

class PurchaseItem extends Model implements PurchaseItemContract
{
    protected $table = 'purchase_items';

    protected $with = ['product', 'purchase'];

    protected $fillable = [
        'name', 'sku', 'description', 'remarks', 'quantity', 'price',
        'spec', 'unit', 'packaging', 'additional_spec',
        'amount', 'purchase_id', 'product_id', 'created_at', 'updated_at',
    ];

    public function purchase()
    {
        return $this->belongsTo(PurchaseProxy::modelClass(), 'purchase_id');
    }

    /**
     * Get the product owns the purchase product.
     */
    public function product()
    {
        return $this->belongsTo(ProductProxy::modelClass(), 'product_id');
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

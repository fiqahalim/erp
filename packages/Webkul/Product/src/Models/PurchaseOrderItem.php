<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;

use Webkul\Product\Models\PurchaseOrderProxy;
use Webkul\Product\Models\ProductProxy;

use Webkul\Product\Contracts\PurchaseOrderItem as PurchaseOrderItemContract;

class PurchaseOrderItem extends Model implements PurchaseOrderItemContract
{
    protected $table = 'purchase_order_items';

    protected $with = ['product', 'purchase'];

    protected $fillable = [
        'name', 'sku', 'description', 'remarks', 'quantity', 'price',
        'amount', 'purchase_order_id', 'product_id', 'created_at', 'updated_at',
        'spec', 'purchaser_remark', 'stock_balance', 'delivery_date',
    ];

    public function purchase()
    {
        return $this->belongsTo(PurchaseOrderProxy::modelClass(), 'purchase_order_id');
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

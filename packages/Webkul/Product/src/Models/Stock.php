<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Contracts\Stock as StockContract;

class Stock extends Model implements StockContract
{
    protected $table = 'stocks';

     protected $casts = [
        'expired_at' => 'date',
    ];

    protected $fillable = [
        'current_stock', 'expired_at', 'product_id', 'user_id',
        'group_id', 'created_at', 'updated_at',
    ];

    /**
     * Get the user that owns the lead.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass());
    }

    /**
     * Get the person that owns the lead.
     */
    public function groups()
    {
        return $this->belongsTo(GroupProxy::modelClass());
    }

    /**
     * Get the products.
     */
    public function products()
    {
        return $this->belongsTo(ProductProxy::modelClass());
    }
}

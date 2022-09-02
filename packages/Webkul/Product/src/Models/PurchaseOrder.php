<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Webkul\Contact\Models\PersonProxy;
use Webkul\Product\Models\ProductProxy;
use Webkul\User\Models\UserProxy;

use Webkul\Product\Contracts\PurchaseOrder as PurchaseOrderContract;

class PurchaseOrder extends Model implements PurchaseOrderContract
{
    protected $table = 'purchase_orders';

    protected $with = ['user', 'person', 'approvedBy'];

    protected $casts = [
        'delivery_date' => 'date',
        'expired_date'  => 'date',
        'approved_date' => 'date',
        'created_at'    => 'datetime',
    ];

    protected $fillable = [
        'purchase_no', 'ref_no', 'delivery_date', 'expired_date', 'progress_status',
        'approved', 'approved_date', 'location_id', 'currency_id', 'transaction_type_id',
        'user_id', 'person_id', 'product_id', 'created_at', 'updated_at', 'approved_by',
    ];

    /**
     * Get the user that owns the lead.
     */
    public function user()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'approved_by');
    }

    /**
     * Get the person that owns the lead.
     */
    public function person()
    {
        return $this->belongsTo(PersonProxy::modelClass());
    }

    /**
     * Get the products.
     */
    public function products()
    {
        return $this->hasMany(ProductProxy::modelClass(), 'product_id');
    }
}

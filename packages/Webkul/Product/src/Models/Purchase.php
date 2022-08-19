<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Webkul\Contact\Models\PersonProxy;
use Webkul\User\Models\UserProxy;

use Webkul\Product\Contracts\Purchase as PurchaseContract;

class Purchase extends Model implements PurchaseContract
{
    protected $table = 'purchases';

    protected $casts = [
        'date' => 'date',
    ];

    protected $fillable = [
        'purchase_no', 'date', 'user_id', 'person_id', 'product_id', 'created_at', 'updated_at',
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
    public function person()
    {
        return $this->belongsTo(PersonProxy::modelClass());
    }

    /**
     * Get the products.
     */
    public function products()
    {
        return $this->hasMany(ProductProxy::modelClass());
    }
}

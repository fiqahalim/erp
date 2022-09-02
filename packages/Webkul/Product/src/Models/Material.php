<?php

namespace Webkul\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Contracts\Material as MaterialContract;

use Webkul\User\Models\UserProxy;
use Webkul\Product\Models\ProductProxy;

class Material extends Model implements MaterialContract
{
    protected $table = 'materials';

    protected $with = ['users', 'approvedBy'];

    protected $casts = [
        'date' => 'date',
        'approved_date' => 'datetime',
    ];

    protected $fillable = [
        'date', 'qc_insp_req_no', 'inspection_method', 'finish_status', 'approved',
        'product_id', 'user_id', 'approved_by', 'created_at', 'updated_at', 'approved_date',
    ];

    /**
     * Get the products.
     */
    public function products()
    {
        return $this->hasMany(ProductProxy::modelClass());
    }

    /**
     * Get the organization that owns the person.
     */
    public function users()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(UserProxy::modelClass(), 'approved_by');
    }
}

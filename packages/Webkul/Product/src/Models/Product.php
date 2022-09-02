<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Traits\CustomAttribute;
use Webkul\Product\Contracts\Product as ProductContract;

use Webkul\Contact\Models\PersonProxy;

class Product extends Model implements ProductContract
{
    use CustomAttribute;

    protected $table = 'products';

    protected $with = ['persons'];

    protected $casts = [
        'item_category'   => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sku', 'description', 'quantity', 'price',
        'spec', 'additional_spec', 'remarks', 'unit',
        'item_category', 'catalogue_number', 'sale_price',
        'lead_time', 'shelf_life', 'status', 'person_id',
        'created_at', 'updated_at',
    ];

    public function persons()
    {
        return $this->belongsTo(PersonProxy::modelClass(), 'person_id');
    }
}

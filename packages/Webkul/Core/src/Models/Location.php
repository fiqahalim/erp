<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\Location as LocationContract;

class Location extends Model implements LocationContract
{
    protected $fillable = [
        'location_code', 'location_name', 'type', 'process_name',
        'outsource_name', 'status', 'other_establish_name', 'tax_rate_sales',
        'tax_rate_purchase',
    ];
}

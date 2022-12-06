<?php

namespace Webkul\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Contracts\IncomingStock as IncomingStockContract;

use Webkul\User\Models\UserProxy;
use Webkul\Product\Models\ProductProxy;
use Webkul\Product\Models\PurchaseProxy;

class IncomingStock extends Model implements IncomingStockContract
{
    protected $table = 'incoming_stocks';

    protected $fillable = [
        'purchasing_organization', '23_material_no', 'quantity_receive', 'quantity_unreceive',
        'spec', 'coa_msds', 'remarks', 'receive_date', 'expiry_date', 'actual_receive_date',
        'manufacture_date', 'status', 'person_id', 'product_id', 'purchase_id', 'created_at', 'updated_at'
    ];
}

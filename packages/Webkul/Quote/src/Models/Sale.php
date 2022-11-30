<?php

namespace Webkul\Quote\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Quote\Contracts\Sale as SaleContract;

class Sale extends Model implements SaleContract
{
    protected $fillable = [];
}
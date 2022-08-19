<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\Currency as CurrencyContract;

class Currency extends Model implements CurrencyContract
{
    protected $fillable = [
        'currency_name',
        'fx_rate',
        'active',
    ];
}

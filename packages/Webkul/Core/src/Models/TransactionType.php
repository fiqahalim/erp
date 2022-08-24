<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\TransactionType as TransactionTypeContract;

class TransactionType extends Model implements TransactionTypeContract
{
    protected $fillable = [
        'transaction_name', 'transaction_code', 'amount', 'created_at', 'updated_at',
    ];
}

<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\Bank as BankContract;

class Bank extends Model implements BankContract
{
    protected $fillable = [];
}
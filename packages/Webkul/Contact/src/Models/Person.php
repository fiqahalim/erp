<?php

namespace Webkul\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Traits\CustomAttribute;
use Webkul\Contact\Contracts\Person as PersonContract;

class Person extends Model implements PersonContract
{
    use CustomAttribute;

    protected $table = 'persons';

    protected $with = 'organization';

    protected $casts = [
        'emails'          => 'array',
        'contact_numbers' => 'array',
        'phone_numbers'   => 'array',
        'fax_numbers'     => 'array',
        'address_1'       => 'array',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'ceo_name', 'bank_name', 'account_no', 'account_holder',
        'business_type', 'business_item', 'contact_numbers', 'phone_numbers', 'fax_numbers',
        'emails', 'keyword', 'supplier_type', 'address_1', 'remarks', 'status', 'created_at', 'updated_at',
    ];

    /**
     * Get the organization that owns the person.
     */
    public function organization()
    {
        return $this->belongsTo(OrganizationProxy::modelClass());
    }
}

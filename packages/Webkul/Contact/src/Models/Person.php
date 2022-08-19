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
        'name', 'code', 'ceo_name', 'business_type', 'business_item',
        'emails', 'phone_numbers', 'fax_numbers', 'keyword',
        'contact_numbers', 'address_1', 'remarks', 'status',
        'organization_id', 'created_at', 'updated_at',
    ];

    /**
     * Get the organization that owns the person.
     */
    public function organization()
    {
        return $this->belongsTo(OrganizationProxy::modelClass());
    }
}

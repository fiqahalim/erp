<?php

namespace Webkul\User\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\User\Contracts\Group as GroupContract;

class Group extends Model implements GroupContract
{
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'address',
    ];

    /**
     * The users that belong to the group.
     */
    public function users()
    {
        return $this->belongsToMany(UserProxy::modelClass(), 'user_groups');
    }
}

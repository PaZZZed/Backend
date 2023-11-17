<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * name of the group table in database
     */
    protected $table = 'Group';

    /**
     * @var bool set increment to false
     */
    public $incrementing = false;

    /**
     * @var bool set timestamps to false
     */
    public $timestamps = false;

}

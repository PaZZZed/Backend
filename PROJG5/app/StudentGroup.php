<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{

    /**
     * name of the studentGroup table in database
     */
    protected $table = 'StudentGroup';
    /**
     * @var bool set increment to false
     */
    public $incrementing = false;

    /**
     * @var bool set timestamps to false
     */
    public $timestamps = false;

    public $fillable = ['group_id','number_id'];
}

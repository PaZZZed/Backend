<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prerequis extends Model
{
    /**
     * @var $table the name of the table
     */
    protected $table = "Prerequis";

    /**
     * @var $incrementing it's for not incrementing the primary key
     */
    public $incrementing = false;

    /**
     * @var $timestamps for not add a column time.
     */
    public $timestamps = false;
}


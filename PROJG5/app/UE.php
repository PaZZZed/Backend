<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UE extends Model
{
    /**
     * @var string the name of the table
     */
    protected $table ='u_e_s';

    /**
     * @var string the primary key of the table
     */
    protected $primaryKey ='UE';
    /**
     * @var string[] Different columns to be filled in the table
     */
    protected $fillable  = ['UE', 'ECTS', 'heures'];

    /**
     * @var bool set false to auto increment
     */
    public $incrementing =false;

    /**
     * @var bool set false to show modified time
     */
    public $timestamps=false;
}

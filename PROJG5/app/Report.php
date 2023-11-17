<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * @var numbers id of the student.
     */
    protected $numbers;

    /**
     * @var UE the course name.
     */
    protected $UE;

    /**
     * @var acquired true if the course is acquired, false otherwise.
     */
    protected $acquired;

    /**
     * @var string Name of the database
     */
    protected $table = 'report';

    /**
     * @var string Name of the database primary key
     */
    protected $primaryKey = ['numbers', 'UE'];

    /**
     * @var string[] Different columns to be filled in the table
     */
     protected $fillable  = ['numbers', 'UE', 'acquired'];

     /**
      * @var bool Checks whether the id is auto-incrementing or not
      */
     public $incrementing = false;

     /**
      * @var bool Checks if every update is joined with a date time
      */
     public $timestamps = false;
    /**
     * @var mixed
     */

}

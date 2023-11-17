<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * @var numbers id of the database student
     */
    protected $numbers;
    /**
     * @var last_name lastname of the student
     */
    protected $last_name;
    /**
     * @var first_name firstname of the student
     */
    protected $first_name;

    /**
     * @var string the name of the database online
     */
    protected $table = 'student';
    /**
     * @var string the name of the primary key of the database
     */
    protected $primaryKey = 'numbers';
    /**
     * @var string[] different variable to be filled in the table
     */
    protected $fillable = ['numbers', 'first_name', 'last_name'];
    /**
     * @var bool check if the id is autoincrementing or not
     */
    public $incrementing = false;
    /**
     * @var bool check if every update is joined with a date time
     */
    public $timestamps = false;

}

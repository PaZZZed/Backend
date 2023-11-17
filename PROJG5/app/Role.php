<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table="roles";
    protected $primaryKey='role_id';
    public $incrementing = true;
    public $timestamps=false;

    protected $fillable = ['nom', 'prenom', 'role', 'mdp'];

}

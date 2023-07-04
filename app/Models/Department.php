<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model 
{

    protected $table = 'departments';
    public $timestamps = true;
    protected $fillable = array('name');

}
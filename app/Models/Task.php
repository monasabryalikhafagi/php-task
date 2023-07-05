<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model 
{

    protected $table = 'tasks';
    public $timestamps = true;
    protected $fillable = array('description', 'employee_id', 'manger_id', 'status', 'title');

}
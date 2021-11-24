<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monthlyexpense extends Model
{
    public $timestamps = false;    
    protected $table = "monthlyexpenses";
	protected $primaryKey = "id_monthlyexpense";
}

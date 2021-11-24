<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalmonthlyexpenses extends Model
{
    //
    public $timestamps = false;
    protected $table = "totalmonthlyexpenses";
	protected $primaryKey = "id_totalmonthlyexpense";
}

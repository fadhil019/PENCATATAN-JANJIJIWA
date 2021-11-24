<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalsales extends Model
{
    //
    public $timestamps = false;
    protected $table = "totalsales";
	protected $primaryKey = "id_totalsales";
}

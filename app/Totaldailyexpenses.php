<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totaldailyexpenses extends Model
{
    //
    public $timestamps = false;
    protected $table = "totaldailyexpenses";
	protected $primaryKey = "id_totaldailyexpense";
}

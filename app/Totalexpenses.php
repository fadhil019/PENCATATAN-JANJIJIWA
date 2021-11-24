<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalexpenses extends Model
{
    public $timestamps = false;
    protected $table = "totalexpenses";
	protected $primaryKey = "id_totalexpenses";
}

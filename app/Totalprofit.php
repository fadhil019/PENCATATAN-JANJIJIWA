<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalprofit extends Model
{
    public $timestamps = false;
    protected $table = "totalprofits";
	protected $primaryKey = "id_totalprofit";
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gajiontime extends Model
{
    public $timestamps = false;
    protected $table = "gajiontimes";
	protected $primaryKey = "id_gajiontime";
}

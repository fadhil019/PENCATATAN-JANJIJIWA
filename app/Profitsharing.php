<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profitsharing extends Model
{
    public $timestamps = false;
    protected $table = "profitsharings";
	protected $primaryKey = "id_profitsharings";
}

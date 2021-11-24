<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listsale extends Model
{
    public $timestamps = false;
    protected $table = "listsales";
	protected $primaryKey = "id_listsales";
}

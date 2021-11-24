<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listexpenses extends Model
{
    public $timestamps = false;    
    protected $table = "listexpenses";
	protected $primaryKey = "id_listexpenses";
}

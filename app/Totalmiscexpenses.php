<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalmiscexpenses extends Model
{
    public $timestamps = false;
    protected $table = "totalmiscexpenses";
	protected $primaryKey = "id_total_misc_expenses";
}

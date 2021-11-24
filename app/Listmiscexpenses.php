<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listmiscexpenses extends Model
{
    public $timestamps = false;
    protected $table = "listmiscexpenses";
	protected $primaryKey = "id_list_misc_expenses";
}

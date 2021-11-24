<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    public $timestamps = false;    
    protected $table = "pegawais";
	protected $primaryKey = "id_pegawais";
}

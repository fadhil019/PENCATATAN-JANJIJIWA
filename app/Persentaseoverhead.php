<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persentaseoverhead extends Model
{
    public $timestamps = false;
    protected $table = "persentaseoverheads";
	protected $primaryKey = "id_persentase_overhead";
}

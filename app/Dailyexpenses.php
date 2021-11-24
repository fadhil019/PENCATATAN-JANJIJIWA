<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dailyexpenses extends Model
{
    public $timestamps = false;
    protected $table = "dailyexpenses";
	protected $primaryKey = "id_dailyexpense";

	// public function formatAngka() {
	// 	return number_format($this->atrribute['nilai_keluar'], 2);
	// }
}

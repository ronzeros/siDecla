<?php

namespace sisDecla;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
	protected $table="Vehiculo";
	protected $primaryKey="vehi_id";
	public $timestamps=false;

	protected $fillable=[
		'declarac_ic',
		'vehi_placa',
		'vehi_fechaAdquisicion',
		'vehi_estado',

	];

	protected $fillguard=[

	];
}

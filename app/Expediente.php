<?php

namespace sisDecla;

use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    protected $table="Expediente";
   	protected $primaryKey="exp_id";
   	public $timestamps=false;

   	protected $filable=[
   		'declarac_id',
   		'id',
   		'exp_numero',
   		'exp_fechaRecepcion',
   		'exp_fechaAtencion',
   		'exp_estado',
   		'exp_procesado',
   		'exp_cerrado'
   	];
}

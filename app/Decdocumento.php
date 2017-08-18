<?php

namespace sisDecla;

use Illuminate\Database\Eloquent\Model;

class Decdocumento extends Model
{
    protected $table="DeclaracionDocumento";
    protected $primaryKey="decdoc_id";
    public $timestamps=false;

    protected $fillable=[
        'declarac_id',
        'vehi_id',
        'doc_id',
        'decdoc_iden',
        'decdoc_nombre',
    	'decdoc_fechaCarga',
    	'decdoc_fechaAtencion',
    	'decdoc_estado',
        'decdoc_activo',
    ];

    protected $fillguard=[
    ];

}
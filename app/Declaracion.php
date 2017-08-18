<?php

namespace sisDecla;

use Illuminate\Database\Eloquent\Model;

class Declaracion extends Model
{
    protected $table="Declaracion";
    protected $primaryKey="declarac_id";
    public $timestamps=false;

    protected $fillable=[
        'tden_id',
        'dist_id',
        'tvia_id',
        'declaran_id',
        'declarac_fecha',
    	'declarac_correo',
    	'declarac_telefono',
    	'declarac_celular',
        'declarac_denUrbana',
        'declarac_etapa',
        'declarac_via',
        'declarac_numero',
        'declarac_manzana',
        'declarac_lote',
        'declarac_interior',
        'declarac_block',
    ];

    protected $fillguard=[
    ];

}
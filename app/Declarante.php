<?php

namespace sisDecla;

use Illuminate\Database\Eloquent\Model;

class Declarante extends Model
{
    protected $table="Declarante";
    protected $primaryKey="declaran_id";
    public $timestamps=false;

    protected $fillable=[
        'usu_id',
        'tden_id',
        'dist_id',
        'tvia_id',
        'declaran_telefono',
    	'declaran_celular',
        'declaran_denUrbana',
        'declaran_etapa',
        'declaran_via',
        'declaran_numero',
        'declaran_manzana',
        'declaran_lote',
        'declaran_interior',
        'declaran_block',
    ];

    protected $fillguard=[
    ];

}

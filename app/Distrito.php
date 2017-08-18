<?php

namespace sisDecla;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $table='Distrito';//nombre de la tabla
    protected $primaryKey='dist_id';//clave primaria
    public $timestamps=false;
    //campos que se incluiran en el modelo
    protected $fillable=[
    	'dist_nombre',
        'dist_estado'
    ];
    //aqui van los campos que no queremos que se asignen al modelo
    protected $guarded=[

    ];
}

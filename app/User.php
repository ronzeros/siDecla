<?php

namespace sisDecla;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table="users";
    protected $primaryKey="id";
    
    protected $fillable = [
        'tusu_id',
        'tdoc_id',
        'tipoPersona',
        'documento',
        'apellidoPaterno',
        'apellidoMaterno',
        'nombres',
        'razonSocial',
        'email',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute(){
        if($this->tipoPersona==1){
            return $this->nombres. ', ' . $this->apellidoPaterno. ' ' . $this->apellidoMaterno;
        }else{
            return $this->razonSocial;
        }
    }
}

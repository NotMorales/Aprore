<?php

namespace App\Traits;

trait UserTrait
{
    public function role(){
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    public function empresa(){
        return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
    }

    public function empresaPriv(){
        return $this->hasOne('App\Models\EmpresaPriv', 'id', 'empresa_id');
    }

    public function persona() {
        return $this->belongsTo('App\Models\Persona');
    }

    public function havePermission( $permiso )
    {
        foreach ( $this->role->permisos as $item) {
            if ( $item->nombre == $permiso ) {
                return true;
            }
        }
        return false;
    }

    public function haveModulo( $modulo )
    {
        foreach ( $this->empresaPriv->modulos as $item) {
            if ( $item->nombre == $modulo ) {
                return true;
            }
        }
        return false;
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
     
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'        => 1,
                'nombre'    => 'Administrador Aprore',
            ],
            [
                'id'        => 2,
                'nombre'    => 'Staff Aprore',
            ],
            [
                'id'        => 3,
                'nombre'    => 'Cliente',
            ],
            [
                'id'        => 4,
                'nombre'    => 'Secretaria Cliente',
            ],
            [
                'id'        => 5,
                'nombre'    => 'Trabajador',
            ]
        ]);

        DB::table('personas')->insert([
            [
                'id'                => 1,
                'nombre'            => 'Luis Antonio',
                'apellido_paterno'  => 'Morales',
                'apellido_Materno'  => 'Velazquez',
                'sexo'              => 'Hombre',
                'telefono'          => '9211479791',
                'fecha_nacimiento'  => '1999-10-24',
            ], 
        ]);

        DB::table('empresas')->insert([
            [
                'id'            => 1,
                'nombre'        => 'Aprore',
                'direccion'     => 'Toluca',
                'correo'        => 'desarollo@aprore.com',
                'contacto'      => 'Luis Morales V',
                'telefono'      => '9211479791',
                'rfc'           => 'MOVL991024',
                'data_base'     => 'aproreco_aprore',
                'logo_path'     =>  '',
            ],
        ]);

        DB::table('users')->insert([
            [
                'id'            => 1,
                'role_id'       => 1,
                'persona_id'    => 1,
                'empresa_id'    => 1,
                'name'          => 'Luis Antonio Morales Velazquez',
                'email'         => 'morales.lamv@gmail.com',
                'password'      => Hash::make('des_2020'),
            ],
        ]);
    }
}

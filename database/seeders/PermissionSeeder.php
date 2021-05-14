<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //PERMISOS
        //Pacientes
        Permission::create(['name' => 'patient.index', 'description'=> 'Listar Pacientes']);
        Permission::create(['name' => 'patient.create', 'description'=> 'Crear Pacientes']);
        Permission::create(['name' => 'patient.show', 'description'=> 'Ver datos de un Paciente']);
        Permission::create(['name' => 'patient.update', 'description'=> 'Actualizar datos de un Paciente']);
        Permission::create(['name' => 'patient.delete', 'description'=> 'Eliminar Pacientes']);

        //muestras
        Permission::create(['name' => 'sample.index', 'description'=> 'Listar Muestras']);
        Permission::create(['name' => 'sample.create', 'description'=> 'Crear Muestras']);
        Permission::create(['name' => 'sample.show', 'description'=> 'Ver datos de una Muestra']);
        Permission::create(['name' => 'sample.update', 'description'=> 'Actualizar datos de una Muestra']);
        Permission::create(['name' => 'sample.delete', 'description'=> 'Eliminar Muestras']);

        //usuarios
        Permission::create(['name' => 'user.index', 'description'=> 'Listar Usuarios']);
        Permission::create(['name' => 'user.create', 'description'=> 'Crear Usuarios']);
        Permission::create(['name' => 'user.show', 'description'=> 'Ver datos de un Usuario']);
        Permission::create(['name' => 'user.update', 'description'=> 'Actualizar datos de un Usuario']);
        Permission::create(['name' => 'user.delete', 'description'=> 'Eliminar Usuarios']);

        //roles
        Permission::create(['name' => 'role.index', 'description'=> 'Listar Roles']);
        Permission::create(['name' => 'role.create', 'description'=> 'Crear Roles']);
        Permission::create(['name' => 'role.show', 'description'=> 'Ver datos de un Rol']);
        Permission::create(['name' => 'role.update', 'description'=> 'Actualizar datos de un Rol']);
        Permission::create(['name' => 'role.delete', 'description'=> 'Eliminar Roles']);

        //permisos
        Permission::create(['name' => 'permission.index', 'description'=> 'Listar Permisos']);
        Permission::create(['name' => 'permission.create', 'description'=> 'Crear Permisos']);
        Permission::create(['name' => 'permission.show', 'description'=> 'Ver datos de un Permiso']);
        Permission::create(['name' => 'permission.update', 'description'=> 'Actualizar datos de un Permiso']);
        Permission::create(['name' => 'permission.delete', 'description'=> 'Eliminar Permisos']);

        //ubicaciones
        Permission::create(['name' => 'ubication.index', 'description'=> 'Listar Ubicaciones']);
        Permission::create(['name' => 'ubication.create', 'description'=> 'Crear Ubicaciones']);
        Permission::create(['name' => 'ubication.show', 'description'=> 'Ver datos de un Ubicación']);
        Permission::create(['name' => 'ubication.update', 'description'=> 'Actualizar datos de un Ubicación']);
        Permission::create(['name' => 'ubication.delete', 'description'=> 'Eliminar Ubicaciones']);
    }
}

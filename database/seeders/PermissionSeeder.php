<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
        Permission::create(['name' => 'patient.index', 'description'=> 'Listar Pacientes', 'guard_name'=>'api']);
        Permission::create(['name' => 'patient.create', 'description'=> 'Crear Pacientes', 'guard_name'=>'api']);
        Permission::create(['name' => 'patient.show', 'description'=> 'Ver datos de un Paciente', 'guard_name'=>'api']);
        Permission::create(['name' => 'patient.update', 'description'=> 'Actualizar datos de un Paciente', 'guard_name'=>'api']);
        Permission::create(['name' => 'patient.delete', 'description'=> 'Eliminar Pacientes', 'guard_name'=>'api']);

        //muestras
        Permission::create(['name' => 'sample.index', 'description'=> 'Listar Muestras', 'guard_name'=>'api']);
        Permission::create(['name' => 'sample.create', 'description'=> 'Crear Muestras', 'guard_name'=>'api']);
        Permission::create(['name' => 'sample.show', 'description'=> 'Ver datos de una Muestra', 'guard_name'=>'api']);
        Permission::create(['name' => 'sample.update', 'description'=> 'Actualizar datos de una Muestra', 'guard_name'=>'api']);
        Permission::create(['name' => 'sample.delete', 'description'=> 'Eliminar Muestras', 'guard_name'=>'api']);

        //usuarios
        Permission::create(['name' => 'user.index', 'description'=> 'Listar Usuarios', 'guard_name'=>'api']);
        Permission::create(['name' => 'user.create', 'description'=> 'Crear Usuarios', 'guard_name'=>'api']);
        Permission::create(['name' => 'user.show', 'description'=> 'Ver datos de un Usuario', 'guard_name'=>'api']);
        Permission::create(['name' => 'user.update', 'description'=> 'Actualizar datos de un Usuario', 'guard_name'=>'api']);
        Permission::create(['name' => 'user.delete', 'description'=> 'Eliminar Usuarios', 'guard_name'=>'api']);

        //roles
        Permission::create(['name' => 'role.index', 'description'=> 'Listar Roles', 'guard_name'=>'api']);
        Permission::create(['name' => 'role.create', 'description'=> 'Crear Roles', 'guard_name'=>'api']);
        Permission::create(['name' => 'role.show', 'description'=> 'Ver datos de un Rol', 'guard_name'=>'api']);
        Permission::create(['name' => 'role.update', 'description'=> 'Actualizar datos de un Rol', 'guard_name'=>'api']);
        Permission::create(['name' => 'role.delete', 'description'=> 'Eliminar Roles', 'guard_name'=>'api']);

        //permisos
        Permission::create(['name' => 'permission.index', 'description'=> 'Listar Permisos', 'guard_name'=>'api']);
        Permission::create(['name' => 'permission.create', 'description'=> 'Crear Permisos', 'guard_name'=>'api']);
        Permission::create(['name' => 'permission.show', 'description'=> 'Ver datos de un Permiso', 'guard_name'=>'api']);
        Permission::create(['name' => 'permission.update', 'description'=> 'Actualizar datos de un Permiso', 'guard_name'=>'api']);
        Permission::create(['name' => 'permission.delete', 'description'=> 'Eliminar Permisos', 'guard_name'=>'api']);

        //ubicaciones
        Permission::create(['name' => 'ubication.index', 'description'=> 'Listar Ubicaciones', 'guard_name'=>'api']);
        Permission::create(['name' => 'ubication.create', 'description'=> 'Crear Ubicaciones', 'guard_name'=>'api']);
        Permission::create(['name' => 'ubication.show', 'description'=> 'Ver datos de un Ubicación', 'guard_name'=>'api']);
        Permission::create(['name' => 'ubication.update', 'description'=> 'Actualizar datos de un Ubicación', 'guard_name'=>'api']);
        Permission::create(['name' => 'ubication.delete', 'description'=> 'Eliminar Ubicaciones', 'guard_name'=>'api']);

        $roleSAdmin = Role::create(['name' => 'SuperAdmin', 'description'=> 'Todos los privilegios', 'guard_name'=>'api']);
        $roleSAdmin->syncPermissions([
            'patient.index', 'patient.show', 'patient.create', 'patient.update','patient.delete',
            'sample.index', 'sample.show', 'sample.create', 'sample.update','sample.delete',
            'user.index', 'user.show', 'user.create', 'user.update','user.delete',
            'ubication.index', 'ubication.show', 'ubication.create', 'ubication.update','ubication.delete',
            'role.index', 'role.show', 'role.create', 'role.update','role.delete',
            'permission.index', 'permission.show', 'permission.create', 'permission.update','permission.delete',
        ]);
    }
}

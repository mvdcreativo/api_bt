<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory(5)->create();
        $userAdmin = User::create([
            'name'=>'Emir',
            'last_name'=>'Mendez',
            'email'=>'mvdcreativo@gmail.com',
            'password'=> Hash::make('12345678')
        ]); 
        $userAdmin->syncRoles([
            'patient.index', 'patient.show', 'patient.create', 'patient.update','patient.delete',
            'sample.index', 'sample.show', 'sample.create', 'sample.update','sample.delete',
            'user.index', 'user.show', 'user.create', 'user.update','user.delete',
            'ubication.index', 'ubication.show', 'ubication.create', 'ubication.update','ubication.delete',
            'role.index', 'role.show', 'role.create', 'role.update','role.delete',
            'permission.index', 'permission.show', 'permission.create', 'permission.update','permission.delete',
        ]);



    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Permission;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
          /* Users table */

        // $myTable = 'users';
        // DB::statement('SET IDENTITY_INSERT '. $table .' ON');
        // DB::table($table)->insert([
        //   "id" => "1",  
        //   "name" => "admin", 
        //   "password" => Hash::make("password"), 
        //   "email" => "admin@lafilgroup.com"
        // ]);a
        // DB::statement('SET IDENTITY_INSERT '. $table .' OFF');
        DB::statement("
            SET IDENTITY_INSERT users ON;
            INSERT INTO users (id, name, password, email) 
            VALUES(1, 'Admin', PWDENCRYPT('password'), 'admin@lafilgroup.com'); 
            SET IDENTITY_INSERT users OFF;
             ");

        $this->command->info('Users table seeded');



         /* Roles table */
        $roles = array(
            array("id" => "1", "name" => "Administrator", "display_name" => "Administrator", "description" => "Overall Administrator"),
            array("id" => "2" ,"name" => "Personnel", "display_name" => "Personnel", "description" => "Personnel"),
        );
        foreach ($roles as $role) {
            Role::create($role);
        }
        $this->command->info('Roles table seeded');

        $role1 = Role::find(1);
        $permissions = Permission::all();

        //Assign all permissions to role administrator
        foreach ($permissions as $permission) {
            $role1->attachPermission($permission);
        }
        //Assign role Superadmin to all permissions
        User::find(1)->attachRole($role1);

      
    }
}

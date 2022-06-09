<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     * создание root-пользователя, amin
     *
     */
    public function run()
    {
    	# по умолчанию назначаем доступ для админа

        $admin = Role::where('slug','admin')->first();
        $account = Role::where('slug', 'account')->first();
        # $user = Role::where('slug', 'user')->first();

        # по умолчанию Permission (Права на доступ к определенной функции) не назначаем, можно в дальшейшем зайдествовать этот функционал.
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();

        
        $user = new User();
        $user->name = 'GM';
        # используйте указанную пару ключей для входа || use login parametsr below to access to your project 
        $user->email = 'dzendigital@gmail.com'; 
        $user->password = bcrypt('dzendigital@gmail.com');
        $user->email_verified_at = now();
        $user->save();
        $user->roles()->attach($admin);

        $user1 = new User();
        $user1->name = 'Admin';
        # используйте указанную пару ключей для входа || use login parametsr below to access to your project 
        $user1->email = 'admin@gmail.com'; 
        $user1->password = bcrypt('admin@gmail.com');
        $user1->email_verified_at = now();
        $user1->save();
        $user1->roles()->attach($admin);

        $user2 = new User();
        $user2->name = 'Account';
        # используйте указанную пару ключей для входа || use login parametsr below to access to your project 
        $user2->email = 'account@gmail.com'; 
        $user2->password = bcrypt('account@gmail.com');
        $user2->email_verified_at = now();
        $user2->save();
        $user2->roles()->attach($account);
    }
}

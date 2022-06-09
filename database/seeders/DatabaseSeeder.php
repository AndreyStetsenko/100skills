<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        # роли, разрешения, доступы, пользователи
        // \App\Models\User::factory(10)->create();
        $this->call(MenuSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        #$this->call(CatalogSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(TarifSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(ActionSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(ContactSeeder::class);
        // $this->call(IndexPageSeeder::class);

    }
}

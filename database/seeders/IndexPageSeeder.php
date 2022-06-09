<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndexPage\IndexPage;

class IndexPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IndexPage::factory()
                ->count(1)
                ->create();
    }
}

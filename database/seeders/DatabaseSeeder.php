<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Synthstuc;
use App\Models\Synthstut;
use App\Models\Synthstue;
use Illuminate\Database\Eloquent\Factories\Factory;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Synthstue::factory(10)->create();
        \App\Models\Synthstut::factory(10)->create();
        \App\Models\Synthstuc::factory(10)->create();

    }
}

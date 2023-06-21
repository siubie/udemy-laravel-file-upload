<?php

namespace Database\Seeders;

use App\Models\PublicFoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicFotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //call public foto factory
        PublicFoto::factory()->count(10)->create();
    }
}

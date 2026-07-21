<?php

namespace Database\Seeders;

use App\Models\User;
use Khudayberdiyev\UzbekistanRegions\Database\Seeders\UzbekistanRegionsSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UzbekistanRegionsSeeder::class);
    }
}

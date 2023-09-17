<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->insertCategory('Category A');
        $this->insertCategory('Category B');
    }

    private function insertCategory(string $name): void
    {
        DB::table('category')->insert([
            'name' => $name,
            'created_at' => Carbon::now()
        ]);
    }
}

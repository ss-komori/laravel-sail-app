<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tweet::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\BorrowRequest;
use Database\Factories\BorrowRequestFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BorrowRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BorrowRequest::factory()->create();
    }
}

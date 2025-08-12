<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Spouse;
use App\Models\Child;
use App\Models\Asset;
use App\Models\FinancialTransaction;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            [
                'name' => 'Anisio',
                'email' => 'anisio.bule@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'), // Troque por uma senha segura
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}

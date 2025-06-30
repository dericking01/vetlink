<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Agent::truncate();
        $csvFile = fopen(base_path('database/seeders/agents.csv'), 'r');
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            if (! $firstline) {
                Agent::create([
                    'phone' => $data['1'],
                    'name' => $data['2'],
                    'email' => $data['3'],
                    'gender' => $data['4'],
                    'location' => $data['5'],
                    'promo_code' => $data['6'],
                    'points' => $data['7'],
                    'agent_id' => $data['8'],
                    'status' => $data['10'],
                    'password' => Hash::make('12345678'),
                    'created_at' => $data['12'],
                    'updated_at' => $data['13']
                ]);
                // dd($data);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}

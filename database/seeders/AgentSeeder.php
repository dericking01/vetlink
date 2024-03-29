<?php

namespace Database\Seeders;

use App\Models\Agent;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            $name = $faker->name;
            $firstLetter = Str::substr($name, 0, 1);
            $randomNumbers = mt_rand(10000, 99999);
            $promoCode = strtoupper($firstLetter) . $randomNumbers;

            // Generate a unique agent ID
            $agentId = 'VET-' . date('Y') . '-' . mt_rand(1000, 9999);

            Agent::create([
                'phone' => $faker->unique()->numerify('255#########'),
                'name' => $name,
                'email' => $faker->unique()->safeEmail,
                'gender' => $faker->randomElement(['M', 'F']),
                'location' => $faker->address,
                'promo_code' => $promoCode,
                'points' => 0,
                'agent_id' => $agentId,
                'password' => Hash::make('12345678'),
                'status' => $faker->randomElement(['Active', 'Inactive']),
            ]);
        }
    }

}

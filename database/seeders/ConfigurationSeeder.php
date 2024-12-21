<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'name' => 'config Wyoming Duffy',
            'address' => 'configfacere ipsum',
            'phone' => '+1 (485) 297-7599',
            'email' => 'config@mailinator.com',
            'logo' => 'files/WJagtTOo2gVPeOrsYWMowuDqR0c5YZR6oNxS2S0d.png'
        ]);
    }
}

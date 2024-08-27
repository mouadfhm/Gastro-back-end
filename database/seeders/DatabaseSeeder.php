<?php

namespace Database\Seeders;

use App\Models\User;
use App\Modules\TypeGeste\Models\TypeGeste;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        TypeGeste::factory()->create([
            ['id'=>1,'name'=>'Rectosigmoidoscopie'],
            ['id'=>2,'name'=>'COLONOSCOPIE'],
            ['id'=>3,'name'=>'FOGD'],
            ['id'=>4,'name'=>'BLOC'],
            ['id'=>5,'name'=>'Autres…'],
        ]);
    }
}

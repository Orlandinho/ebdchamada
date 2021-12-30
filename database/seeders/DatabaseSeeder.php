<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Classroom::factory()->create([
            'class' => 'Adolescentes',
            'slug' => 'adolescentes',
            'description' => 'De 12 a 17 anos'
        ]);

        Classroom::factory()->create([
            'class' => 'Jovens',
            'slug' => 'jovens',
            'description' => 'De 18 a 35 anos'
        ]);

        Classroom::factory()->create([
            'class' => 'Adultos',
            'slug' => 'adultos',
            'description' => 'A partir de 36 anos'
        ]);

        Classroom::factory()->create([
            'class' => 'Crianças',
            'slug' => 'criancas',
            'description' => 'De 8 a 11 anos'
        ]);

        Classroom::factory()->create([
            'class' => 'Catecúmenos',
            'slug' => 'catecumenos',
            'description' => 'Profissão de fé'
        ]);

        Student::factory(12)->create([
            'classroom_id' => 1
        ]);

        Student::factory(8)->create([
            'classroom_id' => 2
        ]);

        Student::factory(35)->create([
            'classroom_id' => 3
        ]);

        Student::factory(12)->create([
            'classroom_id' => 4
        ]);

        Student::factory(18)->create([
            'classroom_id' => 5
        ]);
    }
}

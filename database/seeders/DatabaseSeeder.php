<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'class' => 'Oficiais',
            'slug' => 'oficiais',
            'description' => 'Professores e Administradores'
        ]);

        Classroom::factory()->create([
            'class' => 'Jovens',
            'slug' => 'jovens',
            'description' => 'Alunos entre 18 e 35 anos'
        ]);

        Classroom::factory()->create([
            'class' => 'Adolescentes',
            'slug' => 'adolescentes',
            'description' => 'Alunos entre 12 e 18 anos'
        ]);

        Student::factory(80)->create();

        Role::factory()->create([
            'name' => 'Professor'
        ]);
        Role::factory()->create([
            'name' => 'Assistente'
        ]);
        Role::factory()->create([
            'name' => 'Admin'
        ]);

        User::factory()->create([
            'classroom_id' => 1,
            'role_id' => 3,
            'name' => 'Orlando',
            'email' => 'horllando@hotmail.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'classroom_id' => 2,
            'role_id' => 1,
            'name' => 'Silvio',
            'email' => 'silvio@gmail.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'classroom_id' => 2,
            'role_id' => 1,
            'name' => 'Luciana',
            'email' => 'luciana@example.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'classroom_id' => null,
            'role_id' => 1,
            'name' => 'Aline',
            'email' => 'aline@example.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'classroom_id' => null,
            'role_id' => 1,
            'name' => 'Irene',
            'email' => 'irene@example.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        User::factory()->create([
            'classroom_id' => null,
            'role_id' => 2,
            'name' => 'Fernanda',
            'email' => 'fernanda@example.com',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ]);

        Student::factory()->create([
            'classroom_id' => 1,
            'name' => 'Orlando',
            'slug' => 'orlando',
        ]);

        Student::factory()->create([
            'classroom_id' => 1,
            'name' => 'Silvio',
            'slug' => 'silvio',
        ]);

        Student::factory()->create([
            'classroom_id' => 1,
            'name' => 'Luciana',
            'slug' => 'luciana',
        ]);

        Student::factory()->create([
            'classroom_id' => 1,
            'name' => 'Irene',
            'slug' => 'irene',
        ]);

        Student::factory()->create([
            'classroom_id' => 1,
            'name' => 'Aline',
            'slug' => 'aline',
        ]);

    }
}

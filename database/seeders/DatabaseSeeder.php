<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Domaine;
use App\Models\TestModel;
use App\Models\TypeFormation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // TestModel::create([
        //     'titre' => ['en' => 'My first traduction', 'fr' =>'Ma premiere traduction'],
        //     'body' => ['en' => 'This is the content', 'fr' => 'Ceci est le contenu'],
        // ]);

        // TestModel::create([
        //     'titre' => ['en' => 'My first traduction 2', 'fr' =>'Ma premiere traduction 2'],
        //     'body' => ['en' => 'This is the content 2', 'fr' => 'Ceci est le contenu 2'],
        // ]);

        TypeFormation::create([
            'intitule' => 'video',
        ]);

        TypeFormation::create([
            'intitule' => 'bibliotheque',
        ]);

        TypeFormation::create([
            'intitule' => 'fascicule',
        ]);


        
        User::create([
            'email'=>'user@gmail.com',
            'password'=>Hash::make('useradmin'),
            'role'=>'admin',
            'droits'=>4,
        ]);

        
        // Domaine::create([
        //     'intitule' => ['en' => 'informatics', 'fr' => 'Informatique'],
        //     'date' => '17/04/2022',
        //     'slug' => '',
        // ]);

        // Domaine::create([
        //     'intitule' => ['en' => 'geography', 'fr' => 'geographie'],
        //     'date' => '17/04/2022',
        //     'slug' => '',
        // ]);
    }
}

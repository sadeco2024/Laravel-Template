<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{

    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        //* Usuario inciial
        //!!BORRARLO
        $user = User::create([
            'name' => 'Hermilo A. Sánchez',
            'email' => 'sadecoqr@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('anarquia'),
            'remember_token' => Str::random(10),            
        ]); 

        //* Los menus.
        $this->call([ MenusSeeder::class ]);        

        //* Los datos iniciales necesarios.
        $this->call([ InitialSeeder::class ]);        


        //* Los roles.
        $this->call([ RolesSeeder::class ]);        

        //* Los datos de prueba.
        $this->call([ PruebasSeeder::class ]);  

        $user->assignRole('supadmin');
    }
}

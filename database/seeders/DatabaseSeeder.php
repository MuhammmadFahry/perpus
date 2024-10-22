<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'user',
            'role' => 'user',
            'email' => 'user@gmail.com',
            'isAdmin' => false,
            'password' => Hash::make('user123'),
        ]);

        User::create([
            'name' => 'admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'isAdmin' => true,
            'password' => Hash::make('admin123'),
        ]);

        Setting::create(
            [
                "key" => "fine_amount",
                "value" => 5000,
            ]
        );

        Book::create(
            [
                "title"=> 'Warkop DKI',
                "author" => 'Kasino',
                "publication_year"=> 1997,
                "category"=> 'Non Fiksi',
                "description"=> 'Warkop DKI adalah ikon dunia hiburan Indonesia yang tak tergantikan. Melalui trio legendaris Dono, Kasino, dan Indro, Warkop DKI berhasil menghadirkan tawa dan kebahagiaan selama puluhan tahun. Buku ini menggali perjalanan mereka dari awal karier di dunia radio hingga menjadi salah satu grup komedi terbesar di Indonesia. Dengan gaya humor cerdas, satire sosial, dan kekocakan yang abadi, Warkop DKI telah menciptakan film-film dan sketsa-sketsa yang melekat di hati banyak generasi.',
                "image"=> 'img/books-cover/1729148712-wtoKl7LHnHh7hYEU.jpg',
                "available"=> true
            ]
        );
    }
}

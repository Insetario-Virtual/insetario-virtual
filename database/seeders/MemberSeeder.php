<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = [
            [
                'image_path' => 'regina.png',
                'name'  => 'Regina da Silva Borbacd',
                'role'  => 'Orientadora',
                'active' => true,
            ],
            [
                'image_path' => 'thiago.png',
                'name'  => 'Thiago Grassel dos Reis',
                'role'  => 'Colaborador',
                'active' => true,
            ],
            [
                'image_path' => 'emmily.png',
                'name'  => 'Emmily Eduarda Flamia',
                'role'  => 'Fotógrafa',
                'active' => false,
            ],
            [
                'image_path' => 'ana.png',
                'name'  => 'Ana Luiza Hentz de Moura',
                'role'  => 'Fotógrafa',
                'active' => false,
            ],
            [
                'image_path' => 'luiz.png',
                'name'  => 'Luiz Eduardo Carneiro',
                'role'  => 'Programador',
                'active' => true,
            ],
        ];

        DB::table('members')->insert($team);
    }
}

<?php

namespace Database\Seeders;

use App\Models\SiteContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteContent::create([
            'title' => 'Sobre o Projeto',
            'description' => 'O projeto de criação do Insetário Virtual visa modernizar e expandir o acervo entomológico do IFRS - Campus Bento Gonçalves, possibilitando o acesso online às coleções de insetos. Com a ampliação constante do número de espécies catalogadas no laboratório de Entomologia, surgiu a necessidade de uma plataforma que facilite o registro e a consulta desses dados. O objetivo é oferecer uma ferramenta interativa, onde estudantes das áreas agrárias e biológicas, produtores rurais e demais interessados possam identificar e estudar insetos de relevância agrícola, incluindo tanto pragas como espécies benéficas.',
        ]);

        SiteContent::create([
            'title' => 'Motivação',
            'description' => 'A motivação por trás deste projeto decorre da crescente demanda por recursos tecnológicos que facilitem o estudo de insetos, em especial aqueles de importância agrícola. O Insetário Virtual visa preencher uma lacuna existente, proporcionando uma maneira prática e acessível para que estudantes, pesquisadores e produtores identifiquem e preservem insetos. Além disso, o projeto busca fomentar a conscientização ambiental, destacando a importância dos insetos benéficos, como polinizadores e predadores naturais, no equilíbrio dos ecossistemas agrícolas. Ao disponibilizar essa ferramenta ao público, espera-se promover não só o aprendizado, mas também a responsabilidade ambiental no manejo de culturas agrícolas.',
        ]);
    }
}

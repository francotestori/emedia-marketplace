<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $items = [
            'Diarios, Periodicos y Revistas','Animales',
            'Apuestas y Casino','Belleza',
            'Bodas, Parejas','Celebrities',
            'Cine y Television','Gastronomia',
            'Construccion y Reformas','Crianza y Niños',
            'Dating','Decoración',
            'Manualidades y Bricolage','Erotico',
            'Economía','Paranormal',
            'Fotografía','Diseño',
            'Hogar y Jardin','Humor',
            'Informatica y Programación','Juegos',
            'Legales','Literatura y Cultura',
            'Musica y Espectaculos','Marketing y SEO',
            'Moda','Motor, Automoviles y Motos',
            'Naturaleza y Ecología','Nutrición y Fitness',
            'Tiempo Libre','Politica',
            'Psicología','Religión',
            'Salud','Tecnología',
            'Moviles y Aplicaciones','Viajes y Turismo'
        ];

        foreach ($items as $item){
            Category::create([
                'name' => $item
            ]);
        }
    }
}


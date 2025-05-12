<?php

use Illuminate\Database\Seeder;
use App\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Produtos Mockados
        $products = [
            [
                'name' => 'Monitor LG UltraFine™ 27US500-W',
                'price' => 1451.66,
                'category' => 'Informática',
            ],
            [
                'name' => 'Smart TV 4K LG QNED MiniLED QNED90 de 86 polegadas 2024',
                'price' => 17499.00,
                'category' => 'TV/Áudio',
            ],
            [
                'name' => 'Geladeira LG Side by Side 509 L - 220V',
                'price' => 5699.05,
                'category' => 'Eletrodomésticos',
            ],
            [
                'name' => 'Monitor LG MyView Smart 27SR73U-W Tela IPS 4K 27", WebOS, ThinQ Home, Air Play, Screen Share, Bluetooth Home festival',
                'price' => 1790.61,
                'category' => 'Informática',
            ],
            [
                'name' => 'Capacitor 0.8µF 2100V Forno Micro-Ondas LG EAE62927715',
                'price' => 75.99,
                'category' => 'Peças e Acessórios',
            ],
        ];

        // Inserindo os produtos no banco de dados
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

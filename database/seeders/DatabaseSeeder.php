<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $albumCat = Category::create(['name' => 'Album', 'slug' => 'album']);
        $lightstickCat = Category::create(['name' => 'Lightstick', 'slug' => 'lightstick']);
        $merchCat = Category::create(['name' => 'Merch', 'slug' => 'merchandise']);

        $titles = [
            'NCT WISH Wish Bakery Random', 'CORTIS Color Outside The Lines', 'TXT 7th Year : A Moment of Stillness',
            'TXT 7th Year : A Moment of Stillness POB', 'RIIZE Random Character Peek-Up', 'TWS No Tragedy Romeo Cat Apple',
            'TWS No Tragedy Weverse Album', 'TWS No Tragedy Compact Apple', 'TWS No Tragedy Apple Music',
            'STRAY KIDS Ate Letter Music Korea', 'PLAVE Caligo Part 2 Photobook', 'BTS Arirang Standard Vinyl',
            'EXO REVERXE Big Smini', 'XDINARY HEROES Dead And Platform', 'XDINARY HEROES Dead And Illust',
            'XDINARY HEROES Dead And Photo', 'TXT 7th Year : A Moment of Stillness Keyring', 'IVE Revive+ Loved Ive Makestar',
            'SEVENTEEN Right Here POB', 'ENHYPEN Memorabilia Weverse', 'TREASURE Reboot Photobook',
            'BLACKPINK Born Pink Vinyl', 'NEWJEANS How Sweet Standard', 'LE SSERAFIM Crazy Compact'
        ];

        foreach ($titles as $index => $title) {
            $stock = 15;
            if (in_array($index, [1, 3])) {
                $stock = 0;
            } elseif (in_array($index, [2, 4, 5, 7, 8, 9, 10, 11, 12, 13])) {
                $stock = 5;
            }

            Product::create([
                'category_id' => $albumCat->id,
                'name' => $title,
                'slug' => strtolower(str_replace([' ', ':', '+'], '-', $title)) . '-' . $index,
                'price' => rand(13, 70) * 10000,
                'stock' => $stock,
                'sold_count' => max(50, 4500 - ($index * 160) + rand(0, 120)),
            ]);
        }

        // Add 24 Lightsticks for the 4x6 grid
        $lightstickTitles = [
            'NCT Official Lightstick', 'BTS Army Bomb', 'BLACKPINK Lightstick', 'SEVENTEEN Carat Bong',
            'TWICE Candy Bong', 'EXO Phalanx', 'TXT Moa Bong', 'ENHYPEN Engine Bong',
            'TREASURE Teulight', 'STRAY KIDS Nachimbong', 'ITZY Lightring', 'AESPA Lightstick',
            'NEWJEANS Binky Bong', 'LE SSERAFIM Fim Bong', 'RED VELVET Mandu Bong', 'MAMAMOO Moo Bong',
            'GOT7 Ahgabong', 'MONSTA X Mondoongie', 'ASTRO Robong', 'ATEEZ Lightiny',
            'THE BOYZ Heart Bbyong', 'CRAVITY Lightstick', 'IVE Lightstick', 'NMIXX Lightstick'
        ];

        foreach ($lightstickTitles as $index => $title) {
            Product::create([
                'category_id' => $lightstickCat->id,
                'name' => $title,
                'slug' => strtolower(str_replace([' ', ':', '+'], '-', $title)) . '-ls-' . $index,
                'price' => rand(50, 90) * 10000,
                'stock' => rand(0, 10) > 2 ? 15 : (rand(0, 1) == 1 ? 5 : 0),
                'sold_count' => rand(400, 3800),
            ]);
        }

        // Add 24 Merchandise items for the 4x6 grid
        $merchTitles = [
            'BTS TinyTAN Plush Toy', 'BLACKPINK Character Keyring', 'TWICE Lovelys Pouch', 'SEVENTEEN Bongbongie Cushion',
            'NCT Dream Character Sticky Notes', 'STRAY KIDS Skzoo Mini Plush', 'TXT Moa Character Pen', 'ENHYPEN Logo T-Shirt',
            'TREASURE Truz Figure', 'AESPA SYNK Lanyard', 'ITZY WDZY Blanket', 'NEWJEANS Tokki Phone Case',
            'LE SSERAFIM Fim Logo Cap', 'RED VELVET ReVe Festival Tote Bag', 'EXO Planet Tumbler', 'MAMAMOO MooMoo Badge',
            'ATEEZ Teez-mon Pin', 'THE BOYZ Heart Griptok', 'CRAVITY Character Sticker Set', 'IVE Love Dive Poster',
            'NMIXX Mixx Badge', 'GOT7 Gotoon Mug', 'MONSTA X Twotuckgom Slippers', 'ASTRO Roroha Socks'
        ];

        foreach ($merchTitles as $index => $title) {
            Product::create([
                'category_id' => $merchCat->id,
                'name' => $title,
                'slug' => strtolower(str_replace([' ', ':', '+'], '-', $title)) . '-merch-' . $index,
                'price' => rand(15, 45) * 10000,
                'stock' => rand(0, 10) > 2 ? 20 : (rand(0, 1) == 1 ? 8 : 0),
                'sold_count' => rand(120, 3200),
            ]);
        }
    }
}

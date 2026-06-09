<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // SOCCER
            ['name' => 'Nike Phantom GX Elite FG',      'sport' => 'soccer', 'category' => 'footwear',   'brand' => 'Nike',       'price' => 870,  'old_price' => 990,  'badge' => 'popular', 'stock' => 10, 'description' => 'Engineered for precise ball control with Gripknit upper.',         'tags' => 'Firm Ground,Elite,Grip Control'],
            ['name' => 'Adidas Predator Edge+ FG',       'sport' => 'soccer', 'category' => 'footwear',   'brand' => 'Adidas',     'price' => 750,  'old_price' => null, 'badge' => null,      'stock' => 8,  'description' => 'Zone Skin rubber elements for unrivaled grip and precision.',       'tags' => 'Firm Ground,Primeknit,Precision'],
            ['name' => 'Puma King Platinum FG',          'sport' => 'soccer', 'category' => 'footwear',   'brand' => 'Puma',       'price' => 610,  'old_price' => 680,  'badge' => 'sale',    'stock' => 6,  'description' => 'A legendary boot reborn with premium K-leather.',                 'tags' => 'K-Leather,Classic,Comfort'],
            ['name' => 'Barcelona Home Jersey 24/25',    'sport' => 'soccer', 'category' => 'apparel',    'brand' => 'Nike',       'price' => 375,  'old_price' => 445,  'badge' => 'popular', 'stock' => 15, 'description' => 'Authentic Barcelona home jersey with Dri-FIT ADV technology.',    'tags' => 'Official,Dri-FIT ADV,2024/25'],
            ['name' => 'Real Madrid Home Kit 24/25',     'sport' => 'soccer', 'category' => 'apparel',    'brand' => 'Adidas',     'price' => 400,  'old_price' => null, 'badge' => null,      'stock' => 12, 'description' => 'Official Real Madrid kit with HEAT.RDY technology.',             'tags' => 'Official,HEAT.RDY,2024/25'],
            ['name' => 'Adidas Connect24 Match Ball',    'sport' => 'soccer', 'category' => 'ball',       'brand' => 'Adidas',     'price' => 210,  'old_price' => null, 'badge' => 'popular', 'stock' => 20, 'description' => 'FIFA Basic approved ball for consistent flight.',                 'tags' => 'Size 5,FIFA Basic,All Weather'],
            ['name' => 'Molten F5V5000 Match Ball',      'sport' => 'soccer', 'category' => 'ball',       'brand' => 'Molten',     'price' => 305,  'old_price' => null, 'badge' => 'new',     'stock' => 10, 'description' => 'Premium FIFA Quality Pro match ball, hand-stitched.',            'tags' => 'Size 5,FIFA Quality Pro,Match'],
            ['name' => 'Nike Carbon Shin Guards Pro',    'sport' => 'soccer', 'category' => 'equipment',  'brand' => 'Nike',       'price' => 105,  'old_price' => null, 'badge' => null,      'stock' => 25, 'description' => 'Lightweight carbon-fiber shin guards with compression sleeve.',  'tags' => 'Carbon Fiber,Compression,Protection'],
            ['name' => 'Puma Soccer Backpack 35L',       'sport' => 'soccer', 'category' => 'acc',        'brand' => 'Puma',       'price' => 225,  'old_price' => 280,  'badge' => 'popular', 'stock' => 10, 'description' => 'Dedicated ball compartment and ventilated shoe pocket.',         'tags' => '35L,Ball Compartment,Waterproof'],
            // RUGBY
            ['name' => 'Gilbert Sirius Match Ball',      'sport' => 'rugby',  'category' => 'ball',       'brand' => 'Gilbert',    'price' => 320,  'old_price' => null, 'badge' => 'popular', 'stock' => 10, 'description' => 'World Rugby approved match ball with superior grip.',             'tags' => 'World Rugby,Size 5,Match Ball'],
            ['name' => 'Canterbury Rugby Jersey Pro',    'sport' => 'rugby',  'category' => 'apparel',    'brand' => 'Canterbury', 'price' => 290,  'old_price' => 340,  'badge' => 'sale',    'stock' => 12, 'description' => 'Professional jersey with Vapodri+ fabric.',                      'tags' => 'Vapodri+,Reinforced,Pro Fit'],
            ['name' => 'Adidas All Blacks Replica',      'sport' => 'rugby',  'category' => 'apparel',    'brand' => 'Adidas',     'price' => 350,  'old_price' => null, 'badge' => 'new',     'stock' => 8,  'description' => 'Official All Blacks replica jersey with HEAT.RDY technology.',   'tags' => 'Official,HEAT.RDY,All Blacks'],
            ['name' => 'Canterbury Rugby Cleats',        'sport' => 'rugby',  'category' => 'footwear',   'brand' => 'Canterbury', 'price' => 480,  'old_price' => 550,  'badge' => 'sale',    'stock' => 7,  'description' => '8-stud configuration for maximum grip on grass surfaces.',        'tags' => '8-Stud,Grass,Ankle Support'],
            ['name' => 'Gilbert Rugby Headguard',        'sport' => 'rugby',  'category' => 'equipment',  'brand' => 'Gilbert',    'price' => 185,  'old_price' => null, 'badge' => null,      'stock' => 15, 'description' => 'IRB approved lightweight foam padding.',                         'tags' => 'IRB Approved,Foam,Lightweight'],
            ['name' => 'Rhino Rugby Tackle Bag',         'sport' => 'rugby',  'category' => 'equipment',  'brand' => 'Rhino',      'price' => 420,  'old_price' => null, 'badge' => 'popular', 'stock' => 5,  'description' => 'Heavy-duty tackle shield with high-density foam.',               'tags' => 'Heavy Duty,High-Density,Training'],
            ['name' => 'Gilbert Rugby Kit Bag 60L',      'sport' => 'rugby',  'category' => 'acc',        'brand' => 'Gilbert',    'price' => 260,  'old_price' => null, 'badge' => null,      'stock' => 8,  'description' => 'Spacious 60L holdall with wet/dry compartments.',               'tags' => '60L,Wet/Dry,Team Bag'],
            // BADMINTON
            ['name' => 'Yonex Astrox 99 Pro',           'sport' => 'badminton', 'category' => 'equipment', 'brand' => 'Yonex',   'price' => 890,  'old_price' => 1050, 'badge' => 'popular', 'stock' => 6,  'description' => 'Top-tier attack racket with Rotational Generator System.',        'tags' => 'Attack,4U/G5,BWF Approved'],
            ['name' => 'Li-Ning Axforce 80',             'sport' => 'badminton', 'category' => 'equipment', 'brand' => 'Li-Ning', 'price' => 650,  'old_price' => null, 'badge' => 'new',     'stock' => 8,  'description' => 'Carbon fiber frame with aerodynamic design.',                    'tags' => 'Balanced,Carbon Fiber,BWF Approved'],
            ['name' => 'Victor Thruster K 9900',         'sport' => 'badminton', 'category' => 'equipment', 'brand' => 'Victor',  'price' => 720,  'old_price' => 800,  'badge' => 'sale',    'stock' => 7,  'description' => 'High modulus graphite racket with slim shaft.',                  'tags' => 'High Modulus,Slim Shaft,Aggressive'],
            ['name' => 'Yonex Power Cushion 65Z3',       'sport' => 'badminton', 'category' => 'footwear',  'brand' => 'Yonex',   'price' => 560,  'old_price' => null, 'badge' => 'popular', 'stock' => 10, 'description' => 'Lightweight court shoe with Power Cushion+ technology.',         'tags' => 'Power Cushion+,Lightweight,Court Shoe'],
            ['name' => 'Victor SH-A920 Court Shoes',     'sport' => 'badminton', 'category' => 'footwear',  'brand' => 'Victor',  'price' => 320,  'old_price' => 380,  'badge' => 'sale',    'stock' => 12, 'description' => 'Non-marking sole with hexagonal tread for grip.',               'tags' => 'Non-Marking,Hexagonal Grip,Breathable'],
            ['name' => 'Yonex Tournament Shuttlecocks',  'sport' => 'badminton', 'category' => 'ball',      'brand' => 'Yonex',   'price' => 85,   'old_price' => null, 'badge' => 'popular', 'stock' => 30, 'description' => 'Feather shuttlecocks used in BWF-sanctioned tournaments.',       'tags' => 'Feather,BWF Sanctioned,Speed 77'],
            ['name' => 'Li-Ning Performance T-Shirt',    'sport' => 'badminton', 'category' => 'apparel',   'brand' => 'Li-Ning', 'price' => 110,  'old_price' => 135,  'badge' => 'sale',    'stock' => 20, 'description' => 'Quick-dry AT DRY fabric with four-way stretch.',                'tags' => 'AT DRY,4-Way Stretch,Quick-Dry'],
            ['name' => 'Yonex Active Backpack',          'sport' => 'badminton', 'category' => 'acc',       'brand' => 'Yonex',   'price' => 195,  'old_price' => null, 'badge' => null,      'stock' => 10, 'description' => 'Dedicated racket compartment with thermal pocket.',             'tags' => 'Racket Compartment,Thermal Pocket'],
            ['name' => 'Victor Overgrip 30-Pack',        'sport' => 'badminton', 'category' => 'acc',       'brand' => 'Victor',  'price' => 45,   'old_price' => 60,   'badge' => 'sale',    'stock' => 50, 'description' => 'Tacky grip tape with excellent moisture absorption.',           'tags' => 'Tacky,30-Pack,Moisture Absorb'],
        ];

        foreach ($products as $data) {
            $category = Category::where('name', $data['category'])->first();
            $brand    = Brand::where('name', $data['brand'])->first();

            Product::create([
                'name'        => $data['name'],
                'sport'       => $data['sport'],
                'category_id' => $category->id,
                'brand_id'    => $brand->id,
                'price'       => $data['price'],
                'old_price'   => $data['old_price'],
                'badge'       => $data['badge'],
                'stock'       => $data['stock'],
                'description' => $data['description'],
                'tags'        => $data['tags'],
                'image'       => null,
            ]);
        }
    }
}
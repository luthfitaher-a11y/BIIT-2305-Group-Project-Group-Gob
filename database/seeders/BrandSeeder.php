<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['Nike', 'Adidas', 'Puma', 'Molten', 'Gilbert',
                   'Canterbury', 'Rhino', 'Yonex', 'Li-Ning', 'Victor', 'Uhlsport'];

        foreach ($brands as $name) {
            Brand::create(['name' => $name]);
        }
    }
}
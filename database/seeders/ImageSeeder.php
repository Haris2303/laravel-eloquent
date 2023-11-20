<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            $image = new Image();
            $image->url = "https://ucup.com/image/1.jpg";
            $image->imageable_id = "UCUP";
            $image->imageable_type = Customer::class;
            $image->save();
        } {
            $image = new Image();
            $image->url = "https://ucup.com/image/2.jpg";
            $image->imageable_id = "1";
            $image->imageable_type = Product::class;
            $image->save();
        }
    }
}
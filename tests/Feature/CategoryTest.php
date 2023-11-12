<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testInsert()
    {
        $category = new Category();

        $category->id = "SMARTPHONE";
        $category->name = "Samsung S10 PRO";
        $result = $category->save();

        $this->assertTrue($result);
    }

    public function testInsertMany()
    {
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Category $i"
            ];
        }

        // $result = Category::query()->insert($categories);
        $result = Category::insert($categories);

        $this->assertTrue($result);

        $total = Category::count();
        $this->assertEquals(10, $total);
    }

    public function testFind()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FOOD");

        $this->assertEquals("FOOD", $category->id);
        $this->assertEquals("Food", $category->name);
        $this->assertEquals("Food Category", $category->description);
    }
}

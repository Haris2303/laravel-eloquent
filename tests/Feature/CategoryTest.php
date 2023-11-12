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

    public function testUpdate()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FOOD");
        $category->name = "Food Updated";

        $result = $category->update();
        $this->assertTrue($result);
    }

    public function testSelect()
    {
        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->id = "ID $i";
            $category->name = "Category $i";
            $category->save();
        }

        $categories = Category::whereNull("description")->get();
        $this->assertEquals(5, $categories->count());
        $categories->each(function ($category) {
            $this->assertNull($category->description);

            $category->description = "Updated";
            $category->update();
        });
    }

    public function testUpdateMany()
    {
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Category $i"
            ];
        }

        $result = Category::insert($categories);
        $this->assertTrue($result);

        Category::whereNull("description")->update([
            "description" => "Updated"
        ]);

        $total = Category::where("description", "=", "Updated")->count();
        $this->assertEquals(10, $total);
    }

    public function testDelete()
    {
        $this->seed(CategorySeeder::class);

        $category = Category::find("FOOD");
        $result = $category->delete();
        $this->assertTrue($result);

        $total = Category::count();
        $this->assertEquals(0, $total);
    }

    public function testDeleteMany()
    {
        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "ID $i",
                "name" => "Category $i"
            ];
        }

        $result = Category::insert($categories);
        $this->assertTrue($result);

        $total = Category::count();
        $this->assertEquals(10, $total);

        Category::whereNull('description')->delete();

        $total = Category::count();
        $this->assertEquals(0, $total);
    }
}

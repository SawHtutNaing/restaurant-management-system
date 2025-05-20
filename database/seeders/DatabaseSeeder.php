<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Meal;
use App\Models\Inventory;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Categories
        $categories = [
            ['name' => 'Starters'],
            ['name' => 'Main Courses'],
            ['name' => 'Salads'],
            ['name' => 'Desserts'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Inventories
        $inventories = [
            ['name' => 'Potato', 'type' => 'vegetable', 'stock' => 100.00, 'price_per_kg' => 2.00],
            ['name' => 'Peas', 'type' => 'vegetable', 'stock' => 50.00, 'price_per_kg' => 3.00],
            ['name' => 'Lamb', 'type' => 'meat', 'stock' => 20.00, 'price_per_kg' => 15.00],
            ['name' => 'Tea Leaves', 'type' => 'vegetable', 'stock' => 30.00, 'price_per_kg' => 5.00],
        ];

        $inventoryIds = [];
        foreach ($inventories as $inventory) {
            $inventoryIds[] = Inventory::create($inventory)->id;
        }

        // Create Meals
        $meals = [
            [
                'name' => 'Samosas',
                'category_id' => 1,
                'price' => 8.00,
                'description' => 'Crispy pastry filled with spiced potato and peas',
                'inventories' => [
                    [$inventoryIds[0], 2.00], // Potato: 2 units
                    [$inventoryIds[1], 1.00], // Peas: 1 unit
                ],
            ],
            [
                'name' => 'Lamb Curry',
                'category_id' => 2,
                'price' => 22.00,
                'description' => 'Tender lamb in a rich curry',
                'inventories' => [
                    [$inventoryIds[2], 3.00], // Lamb: 3 units
                ],
            ],
        ];

        foreach ($meals as $mealData) {
            $inventories = $mealData['inventories'];
            unset($mealData['inventories']);
            $meal = Meal::create($mealData);
            foreach ($inventories as $inventory) {
                $meal->inventories()->attach($inventory[0], ['quantity' => $inventory[1]]);
            }
        }
    }


}

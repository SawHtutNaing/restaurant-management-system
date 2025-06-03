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


        $this->call([
            UserSeeder::class

        ]);
         $categories = [
            ['name' => 'Starters'],
            ['name' => 'Main Courses'],
            ['name' => 'Salads'],
            ['name' => 'Desserts'],
            ['name' => 'Beverages'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Inventories
        $inventories = [
            ['name' => 'Potato', 'type' => 'vegetable', 'stock' => 100, 'price_per_kg' => 2],
            ['name' => 'Peas', 'type' => 'vegetable', 'stock' => 50, 'price_per_kg' => 3],
            ['name' => 'Lamb', 'type' => 'meat', 'stock' => 20, 'price_per_kg' => 15],
            ['name' => 'Tea Leaves', 'type' => 'vegetable', 'stock' => 30, 'price_per_kg' => 5],
            ['name' => 'Chicken', 'type' => 'meat', 'stock' => 40, 'price_per_kg' => 8],
            ['name' => 'Tomato', 'type' => 'vegetable', 'stock' => 60, 'price_per_kg' => 2],
            ['name' => 'Rice', 'type' => 'grain', 'stock' => 80, 'price_per_kg' => 1],
            ['name' => 'Spinach', 'type' => 'vegetable', 'stock' => 30, 'price_per_kg' => 3],
            ['name' => 'Beef', 'type' => 'meat', 'stock' => 25, 'price_per_kg' => 12],
            ['name' => 'Carrot', 'type' => 'vegetable', 'stock' => 50, 'price_per_kg' => 2],
            ['name' => 'Chocolate', 'type' => 'dessert', 'stock' => 15, 'price_per_kg' => 10],
            ['name' => 'Milk', 'type' => 'dairy', 'stock' => 40, 'price_per_kg' => 1],
            ['name' => 'Cucumber', 'type' => 'vegetable', 'stock' => 35, 'price_per_kg' => 1],
            ['name' => 'Shrimp', 'type' => 'seafood', 'stock' => 20, 'price_per_kg' => 18],
            ['name' => 'Lemon', 'type' => 'fruit', 'stock' => 25, 'price_per_kg' => 3],
            ['name' => 'Flour', 'type' => 'grain', 'stock' => 60, 'price_per_kg' => 1],
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
                'price' => 8,
                'description' => 'Crispy pastry filled with spiced potato and peas',
                'inventories' => [
                    [$inventoryIds[0], 2], // Potato
                    [$inventoryIds[1], 1], // Peas
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Lamb Curry',
                'category_id' => 2,
                'price' => 22,
                'description' => 'Tender lamb in a rich curry sauce',
                'inventories' => [
                    [$inventoryIds[2], 3], // Lamb
                    [$inventoryIds[5], 1], // Tomato
                ],
            ],
            [
                'name' => 'Caesar Salad',
                'category_id' => 3,
                'price' => 10,
                'description' => 'Fresh romaine with Caesar dressing and croutons',
                'inventories' => [
                    [$inventoryIds[7], 1], // Spinach
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Chocolate Cake',
                'category_id' => 4,
                'price' => 12,
                'description' => 'Rich chocolate layered cake',
                'inventories' => [
                    [$inventoryIds[10], 1], // Chocolate
                    [$inventoryIds[11], 1], // Milk
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Iced Tea',
                'category_id' => 5,
                'price' => 4,
                'description' => 'Refreshing lemon-infused iced tea',
                'inventories' => [
                    [$inventoryIds[3], 1], // Tea Leaves
                    [$inventoryIds[14], 1], // Lemon
                ],
            ],
            [
                'name' => 'Spring Rolls',
                'category_id' => 1,
                'price' => 7,
                'description' => 'Crispy rolls with vegetables',
                'inventories' => [
                    [$inventoryIds[9], 1], // Carrot
                    [$inventoryIds[12], 1], // Cucumber
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Chicken Tikka',
                'category_id' => 2,
                'price' => 18,
                'description' => 'Grilled spiced chicken skewers',
                'inventories' => [
                    [$inventoryIds[4], 3], // Chicken
                    [$inventoryIds[5], 1], // Tomato
                ],
            ],
            [
                'name' => 'Greek Salad',
                'category_id' => 3,
                'price' => 9,
                'description' => 'Cucumber, tomato, and feta salad',
                'inventories' => [
                    [$inventoryIds[12], 1], // Cucumber
                    [$inventoryIds[5], 1], // Tomato
                ],
            ],
            [
                'name' => 'Mango Sorbet',
                'category_id' => 4,
                'price' => 6,
                'description' => 'Chilled mango dessert',
                'inventories' => [
                    [$inventoryIds[14], 1], // Lemon
                ],
            ],
            [
                'name' => 'Shrimp Fried Rice',
                'category_id' => 2,
                'price' => 20,
                'description' => 'Stir-fried rice with shrimp and vegetables',
                'inventories' => [
                    [$inventoryIds[13], 2], // Shrimp
                    [$inventoryIds[6], 2], // Rice
                    [$inventoryIds[1], 1], // Peas
                ],
            ],
            [
                'name' => 'Bruschetta',
                'category_id' => 1,
                'price' => 6,
                'description' => 'Toasted bread with tomato topping',
                'inventories' => [
                    [$inventoryIds[5], 1], // Tomato
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Beef Stir-Fry',
                'category_id' => 2,
                'price' => 19,
                'description' => 'Beef with mixed vegetables',
                'inventories' => [
                    [$inventoryIds[8], 2], // Beef
                    [$inventoryIds[9], 1], // Carrot
                    [$inventoryIds[1], 1], // Peas
                ],
            ],
            [
                'name' => 'Caprese Salad',
                'category_id' => 3,
                'price' => 10,
                'description' => 'Tomato, mozzarella, and basil salad',
                'inventories' => [
                    [$inventoryIds[5], 1], // Tomato
                    [$inventoryIds[11], 1], // Milk
                ],
            ],
            [
                'name' => 'Lemon Tart',
                'category_id' => 4,
                'price' => 8,
                'description' => 'Tangy lemon curd in a pastry crust',
                'inventories' => [
                    [$inventoryIds[14], 1], // Lemon
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Chicken Biryani',
                'category_id' => 2,
                'price' => 21,
                'description' => 'Spiced rice with chicken',
                'inventories' => [
                    [$inventoryIds[4], 3], // Chicken
                    [$inventoryIds[6], 2], // Rice
                ],
            ],
            [
                'name' => 'Vegetable Soup',
                'category_id' => 1,
                'price' => 6,
                'description' => 'Hearty vegetable broth',
                'inventories' => [
                    [$inventoryIds[0], 1], // Potato
                    [$inventoryIds[9], 1], // Carrot
                    [$inventoryIds[7], 1], // Spinach
                ],
            ],
            [
                'name' => 'Tiramisu',
                'category_id' => 4,
                'price' => 11,
                'description' => 'Coffee-flavored layered dessert',
                'inventories' => [
                    [$inventoryIds[10], 1], // Chocolate
                    [$inventoryIds[11], 1], // Milk
                ],
            ],
            [
                'name' => 'Green Smoothie',
                'category_id' => 5,
                'price' => 5,
                'description' => 'Spinach and fruit blended drink',
                'inventories' => [
                    [$inventoryIds[7], 1], // Spinach
                    [$inventoryIds[14], 1], // Lemon
                ],
            ],
            [
                'name' => 'Shrimp Cocktail',
                'category_id' => 1,
                'price' => 12,
                'description' => 'Chilled shrimp with dipping sauce',
                'inventories' => [
                    [$inventoryIds[13], 2], // Shrimp
                    [$inventoryIds[5], 1], // Tomato
                ],
            ],
            [
                'name' => 'Vegetable Curry',
                'category_id' => 2,
                'price' => 16,
                'description' => 'Mixed vegetables in curry sauce',
                'inventories' => [
                    [$inventoryIds[0], 1], // Potato
                    [$inventoryIds[1], 1], // Peas
                    [$inventoryIds[9], 1], // Carrot
                ],
            ],
            [
                'name' => 'Cobb Salad',
                'category_id' => 3,
                'price' => 11,
                'description' => 'Salad with chicken and vegetables',
                'inventories' => [
                    [$inventoryIds[4], 1], // Chicken
                    [$inventoryIds[12], 1], // Cucumber
                    [$inventoryIds[5], 1], // Tomato
                ],
            ],
            [
                'name' => 'Panna Cotta',
                'category_id' => 4,
                'price' => 9,
                'description' => 'Creamy vanilla dessert',
                'inventories' => [
                    [$inventoryIds[11], 1], // Milk
                ],
            ],
            [
                'name' => 'Masala Chai',
                'category_id' => 5,
                'price' => 4,
                'description' => 'Spiced Indian tea',
                'inventories' => [
                    [$inventoryIds[3], 1], // Tea Leaves
                    [$inventoryIds[11], 1], // Milk
                ],
            ],
            [
                'name' => 'Stuffed Mushrooms',
                'category_id' => 1,
                'price' => 8,
                'description' => 'Mushrooms with cheese filling',
                'inventories' => [
                    [$inventoryIds[11], 1], // Milk
                ],
            ],
            [
                'name' => 'Beef Tacos',
                'category_id' => 2,
                'price' => 15,
                'description' => 'Soft tacos with spiced beef',
                'inventories' => [
                    [$inventoryIds[8], 2], // Beef
                    [$inventoryIds[5], 1], // Tomato
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Waldorf Salad',
                'category_id' => 3,
                'price' => 10,
                'description' => 'Apple, celery, and walnut salad',
                'inventories' => [
                    [$inventoryIds[12], 1], // Cucumber
                ],
            ],
            [
                'name' => 'Cheesecake',
                'category_id' => 4,
                'price' => 10,
                'description' => 'Creamy cheesecake with graham crust',
                'inventories' => [
                    [$inventoryIds[11], 1], // Milk
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Lemonade',
                'category_id' => 5,
                'price' => 4,
                'description' => 'Freshly squeezed lemonade',
                'inventories' => [
                    [$inventoryIds[14], 1], // Lemon
                ],
            ],
            [
                'name' => 'Garlic Bread',
                'category_id' => 1,
                'price' => 5,
                'description' => 'Toasted bread with garlic butter',
                'inventories' => [
                    [$inventoryIds[15], 1], // Flour
                ],
            ],
            [
                'name' => 'Grilled Chicken',
                'category_id' => 2,
                'price' => 17,
                'description' => 'Herb-marinated grilled chicken breast',
                'inventories' => [
                    [$inventoryIds[4], 2], // Chicken
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

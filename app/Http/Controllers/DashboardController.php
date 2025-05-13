<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = $request->query('category');

        if ($selectedCategory) {
            $meals = Meal::where('category_id', $selectedCategory)->get();
        } else {
            $meals = Meal::all();
        }

        return view('welcome', compact('categories', 'meals', 'selectedCategory'));
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MealsExport;

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

        $signatureMeals = Meal::where('is_signature', true)->get();

        return view('welcome', compact('categories', 'meals', 'signatureMeals', 'selectedCategory'));
    }

    public function downloadMenu()
    {
        return Excel::download(new MealsExport, 'menu.xlsx');
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $meal = Meal::findOrFail($request->meal_id);
        $totalPrice = $meal->price * $request->quantity;

        Order::create([
            'user_id' => Auth::id(),
            'meal_id' => $request->meal_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'ordered',
        ]);

        return redirect()->route('home')->with('success', 'Order placed successfully! Awaiting confirmation.');
    }

    public function storeReservation(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1|max:20',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'notes' => 'nullable|string|max:1000',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'guests' => $request->guests,
            'date' => $request->date,
            'time' => $request->time,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Reservation request submitted successfully!');
    }
}

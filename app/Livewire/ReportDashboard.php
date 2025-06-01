<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\IngredientMeal;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class ReportDashboard extends Component
{
    use WithPagination;

    public $dateFilter = 'all';
    public $statusFilter = '';

    public function updatingDateFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();
        $isAdmin = $user && $user->role === 'admin';

        // Date filter logic
        $query = match ($this->dateFilter) {
            'today' => now()->startOfDay(),
            'week' => now()->startOfWeek(),
            'month' => now()->startOfMonth(),
            'year' => now()->startOfYear(),
            default => null,
        };

        // Orders data
        $ordersQuery = Order::query()->with('meal');
        if (!$isAdmin) {
            $ordersQuery->where('user_id', $user->id);
        }
        if ($this->statusFilter) {
            $ordersQuery->where('status', $this->statusFilter);
        }
        if ($query) {
            $ordersQuery->where('created_at', '>=', $query);
        }
        $orders = $ordersQuery->latest()->paginate(10);
        $ordersSummary = $ordersQuery->select(
            DB::raw('COUNT(*) as total_orders'),
            DB::raw('SUM(total_price) as total_revenue')
        )->first();
        $ordersByStatus = Order::query()
            ->when(!$isAdmin, fn($q) => $q->where('user_id', $user->id))
            ->when($query, fn($q) => $q->where('created_at', '>=', $query))
            ->groupBy('status')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->pluck('count', 'status')
            ->toArray();
        $ordersOverTime = Order::query()
            ->when(!$isAdmin, fn($q) => $q->where('user_id', $user->id))
            ->when($query, fn($q) => $q->where('created_at', '>=', $query))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->orderBy('date', 'desc')
            ->pluck('count', 'date')
            ->toArray();

        // Reservations data
        $reservationsQuery = Reservation::query();
        if (!$isAdmin) {
            $reservationsQuery->where('user_id', $user->id);
        }
        if ($this->statusFilter) {
            $reservationsQuery->where('status', $this->statusFilter);
        }
        if ($query) {
            $reservationsQuery->where('date', '>=', $query);
        }
        $reservations = $reservationsQuery->latest()->paginate(10);
        $reservationsSummary = $reservationsQuery->select(
            DB::raw('COUNT(*) as total_reservations'),
            DB::raw('SUM(guests) as total_guests')
        )->first();
        $reservationsByStatus = $reservationsQuery->groupBy('status')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->pluck('count', 'status')
            ->toArray();
        $reservationsByDate = $reservationsQuery->groupBy('date')
            ->select('date', DB::raw('COUNT(*) as count'))
            ->orderBy('date', 'desc')
            ->pluck('count', 'date')
            ->toArray();

        // Income vs Expense
        $incomeQuery = Order::query();
        if ($query) {
            $incomeQuery->where('created_at', '>=', $query);
        }
        $totalIncome = $incomeQuery->sum('total_price');

        $expenseQuery = IngredientMeal::query()
            ->join('orders', 'ingredient_meal.meal_id', '=', 'orders.meal_id')
            ->join('inventories', 'ingredient_meal.inventory_id', '=', 'inventories.id')
            ->join('meals', 'ingredient_meal.meal_id', '=', 'meals.id');
        if ($query) {
            $expenseQuery->where('orders.created_at', '>=', $query);
        }
        $totalExpense = $expenseQuery->select(
            DB::raw('SUM(ingredient_meal.quantity * inventories.price_per_kg * orders.quantity) as total_cost')
        )->first()->total_cost ?? 0;

        return view('livewire.report-dashboard', [
            'orders' => $orders,
            'reservations' => $reservations,
            'ordersSummary' => $ordersSummary,
            'ordersByStatus' => $ordersByStatus,
            'ordersOverTime' => $ordersOverTime,
            'reservationsSummary' => $reservationsSummary,
            'reservationsByStatus' => $reservationsByStatus,
            'reservationsByDate' => $reservationsByDate,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
        ])->layout('layouts.app');
    }
}

<?php
namespace App\Livewire;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Meal;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MealManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $name, $category_id, $price, $description, $image, $mealImage, $is_signature = false;
    public $ingredients = [];
    public $editing = false;
    public $mealId;
    public $search = '';
    public $minPrice = 0;
    public $filterCategory = '';
    public $filterPriceMin = '';
    public $filterPriceMax = '';
    public $orderQuantity = [];
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'is_signature' => 'boolean',
        'ingredients.*' => 'numeric|min:0',
        'orderQuantity.*' => 'nullable|integer|min:1',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        $meals = Meal::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->when($this->filterCategory, fn($query) => $query->where('category_id', $this->filterCategory))
            ->when($this->filterPriceMin, fn($query) => $query->where('price', '>=', $this->filterPriceMin))
            ->when($this->filterPriceMax, fn($query) => $query->where('price', '<=', $this->filterPriceMax))
            ->with(['category', 'ingredients'])
            ->paginate(10);

        return view('livewire.meal-management', [
            'meals' => $meals,
            'categories' => Category::all(),
            'inventories' => Inventory::all(),
        ])->layout('layouts.app');
    }

    public function openModal($edit = false, $id = null)
    {
        $this->resetForm();
        if ($edit && $id) {
            $this->edit($id);
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function create()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('meals', 'public');
        }

        $meal = Meal::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath,
            'is_signature' => $this->is_signature,
        ]);

        $this->syncIngredients($meal);

        $this->closeModal();
        session()->flash('message', 'Meal created successfully.');
    }

    public function edit($id)
    {
        $meal = Meal::with('ingredients')->findOrFail($id);
        $this->mealId = $id;
        $this->name = $meal->name;
        $this->category_id = $meal->category_id;
        $this->price = $meal->price;
        $this->description = $meal->description;
        $this->mealImage = $meal->image;
        $this->is_signature = $meal->is_signature;
        $this->ingredients = $meal->ingredients->pluck('pivot.quantity', 'id')->toArray();
        $this->minPrice = $meal->calculateMinimumPrice();
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        $meal = Meal::findOrFail($this->mealId);
        $imagePath = $meal->image;

        if ($this->image) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $this->image->store('meals', 'public');
        }

        $meal->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath,
            'is_signature' => $this->is_signature,
        ]);

        $this->syncIngredients($meal);

        $this->closeModal();
        session()->flash('message', 'Meal updated successfully.');
    }

    public function delete($id)
    {
        $meal = Meal::findOrFail($id);
        if ($meal->image) {
            Storage::disk('public')->delete($meal->image);
        }
        $meal->delete();
        session()->flash('message', 'Meal deleted successfully.');
    }

    public function addIngredient($inventoryId)
    {
        if (!array_key_exists($inventoryId, $this->ingredients)) {
            $this->ingredients[$inventoryId] = 0;
        }
        $this->updateMinPrice();
    }

    public function removeIngredient($inventoryId)
    {
        unset($this->ingredients[$inventoryId]);
        $this->updateMinPrice();
    }

    public function updatedIngredients()
    {
        $this->updateMinPrice();
    }

    public function updateMinPrice()
    {
        $totalCost = 0;
        foreach ($this->ingredients as $inventoryId => $quantity) {
            $inventory = Inventory::find($inventoryId);
            if ($inventory && $quantity > 0) {
                $totalCost += $inventory->price_per_kg * $quantity;
            }
        }
        $this->minPrice = round($totalCost, 2);
    }

    public function placeOrder($mealId)
    {
        $this->validate(['orderQuantity.' . $mealId => 'required|integer|min:1']);

        $meal = Meal::findOrFail($mealId);
        Order::create([
            'user_id' => auth()->id(),
            'meal_id' => $mealId,
            'quantity' => $this->orderQuantity[$mealId],
            'total_price' => $meal->price * $this->orderQuantity[$mealId],
            'status' => 'ordered',
        ]);

        $this->orderQuantity[$mealId] = null;
        session()->flash('message', 'Order placed successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->category_id = '';
        $this->price = 0;
        $this->description = '';
        $this->image = null;
        $this->mealImage = null;
        $this->is_signature = false;
        $this->ingredients = [];
        $this->editing = false;
        $this->mealId = null;
        $this->minPrice = 0;
        $this->orderQuantity = [];
    }

    protected function syncIngredients($meal)
    {
        $meal->ingredients()->detach();
        foreach ($this->ingredients as $inventoryId => $quantity) {
            if ($quantity > 0) {
                $meal->ingredients()->attach($inventoryId, ['quantity' => $quantity]);
            }
        }
    }

    public function getRules()
    {
        return array_merge($this->rules, [
            'price' => ['required', 'numeric', 'min:' . $this->minPrice],
        ]);
    }
}

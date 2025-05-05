<?php
namespace App\Livewire;

use App\Models\Inventory;
use Livewire\Component;
use Livewire\WithPagination;

class InventoryManagement extends Component
{
    use WithPagination;

    public $name, $type, $stock, $price_per_kg;
    public $editing = false;
    public $inventoryId;
    public $search = '';
    public $showModal = false; // New property for modal visibility

    protected $rules = [
        'name' => 'required|string|max:255',
        'type' => 'required|in:meat,fruit,vegetable',
        'stock' => 'required|numeric|min:0',
        'price_per_kg' => 'required|numeric|min:0',
    ];

    public function render()
    {
        $inventories = Inventory::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.inventory-management', [
            'inventories' => $inventories,
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

        Inventory::create([
            'name' => $this->name,
            'type' => $this->type,
            'stock' => $this->stock,
            'price_per_kg' => $this->price_per_kg,
        ]);

        $this->closeModal();
        session()->flash('message', 'Inventory item created successfully.');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        $this->inventoryId = $id;
        $this->name = $inventory->name;
        $this->type = $inventory->type;
        $this->stock = $inventory->stock;
        $this->price_per_kg = $inventory->price_per_kg;
        $this->editing = true;
    }

    public function update()
    {
        $this->validate();

        Inventory::findOrFail($this->inventoryId)->update([
            'name' => $this->name,
            'type' => $this->type,
            'stock' => $this->stock,
            'price_per_kg' => $this->price_per_kg,
        ]);

        $this->closeModal();
        session()->flash('message', 'Inventory item updated successfully.');
    }

    public function delete($id)
    {
        $inventory = Inventory::findOrFail($id);
        if ($inventory->meals()->count() > 0) {
            session()->flash('error', 'Cannot delete inventory item: it is used in meals.');
            return;
        }
        $inventory->delete();
        session()->flash('message', 'Inventory item deleted successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->type = '';
        $this->stock = '';
        $this->price_per_kg = '';
        $this->editing = false;
        $this->inventoryId = null;
    }
}

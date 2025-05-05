<?php
namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryManagement extends Component
{
    use WithPagination;

    public $name;
    public $editing = false;
    public $categoryId;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.category-management', [
            'categories' => $categories,
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
        ]);

        $this->resetForm();
        session()->flash('message', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->editing = true;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->categoryId,
        ];

        $this->validate($rules);

        Category::findOrFail($this->categoryId)->update([
            'name' => $this->name,
        ]);

        $this->resetForm();
        session()->flash('message', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->meals()->count() > 0) {
            session()->flash('warning', 'Category has associated meals that will be deleted.');
        }
        $category->delete();
        session()->flash('message', 'Category deleted successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->editing = false;
        $this->categoryId = null;
    }
}

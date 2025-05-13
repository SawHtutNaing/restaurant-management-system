<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserManagement extends Component
{
    use WithPagination;

    public $name, $email, $password, $role;
    public $editing = false;
    public $userId;
    public $search = '';
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'required|in:customer,waiter,admin',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.user-management', [
            'users' => $users,
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

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        $this->closeModal();
        session()->flash('message', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = '';
        $this->editing = true;
    }

    public function update()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'role' => 'required|in:customer,waiter,admin',
            'password' => 'nullable|string|min:8',
        ];

        $this->validate($rules);

        $user = User::findOrFail($this->userId);
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        $this->closeModal();
        session()->flash('message', 'User updated successfully.');
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Cannot delete the currently logged-in user.');
            return;
        }

        $user = User::findOrFail($id);
        if ($user->orders()->count() > 0) {
            session()->flash('error', 'Cannot delete user: they have associated orders.');
            return;
        }

        $user->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = '';
        $this->editing = false;
        $this->userId = null;
    }
}

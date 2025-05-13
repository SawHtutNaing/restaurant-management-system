<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isWaiter()
    {
        return $this->role === 'waiter';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}

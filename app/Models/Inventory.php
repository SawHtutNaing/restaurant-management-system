<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'type',
        'stock',
        'price_per_kg',
    ];

    protected $casts = [
        'type' => 'string',
        'stock' => 'decimal:2',
        'price_per_kg' => 'decimal:2',
    ];

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'ingredient_meal')
                    ->withPivot('quantity');
    }
}

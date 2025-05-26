<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description',
        'image',
        'is_signature'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Inventory::class, 'ingredient_meal')
                    ->withPivot('quantity');
    }
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'ingredient_meal')->withPivot('quantity');
    }
    public function calculateMinimumPrice()
    {
        $totalCost = $this->ingredients->sum(function ($ingredient) {
            return $ingredient->price_per_kg * $ingredient->pivot->quantity;
        });
        return round($totalCost, 2);
    }
}

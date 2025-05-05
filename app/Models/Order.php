<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'meal_id',
        'quantity',
        'total_price',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function canBeConfirmed()
    {
        $meal = $this->meal()->with('ingredients')->first();
        foreach ($meal->ingredients as $ingredient) {
            $requiredQuantity = $ingredient->pivot->quantity * $this->quantity;
            if ($ingredient->stock < $requiredQuantity) {
                return false;
            }
        }
        return true;
    }

    public function confirm()
    {
        if ($this->canBeConfirmed()) {
            $meal = $this->meal()->with('ingredients')->first();
            foreach ($meal->ingredients as $ingredient) {
                $requiredQuantity = $ingredient->pivot->quantity * $this->quantity;
                $ingredient->decrement('stock', $requiredQuantity);
            }
            $this->update(['status' => 'confirmed']);
            return true;
        }
        return false;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'guests',
        'date',
        'time',
        'notes',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'string',
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

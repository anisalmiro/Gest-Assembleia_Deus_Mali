<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'expense_date',
        'category',
        'notes'
    ];

    protected $casts = [
        'expense_date' => 'datetime',
        'amount' => 'decimal:2',
    ];
}

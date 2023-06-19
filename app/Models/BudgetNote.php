<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'note',
        'created_at',
    ];
}

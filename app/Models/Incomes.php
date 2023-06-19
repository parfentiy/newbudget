<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum',
        'incomes_types_id',
        'user_id',
        'created_at',
    ];
}

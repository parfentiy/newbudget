<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'sum',
        'expensestypes_id',
        'user_id',
        'comment',
        'created_at',
    ];

}

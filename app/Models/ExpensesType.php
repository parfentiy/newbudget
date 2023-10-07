<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensesType extends Model
{
    use HasFactory;

    protected $table ='expensestypes';

    protected $fillable = [
        'name',
        'is_percent',
        'percent',
        'order_num',
    ];
}

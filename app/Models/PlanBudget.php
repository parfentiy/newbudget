<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanBudget extends Model
{
    use HasFactory;
<<<<<<< HEAD

    protected $fillable = [
        'dataset',
        'month',
        'year',
        'user_id',
        'description',
        'incomes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

=======
    protected $fillable = [
        'expensestypes_id',
        'sum',
        'month',
        'year',
        'ordernum_id',
    ];
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
}

<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'password',
        'remember_token',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'dob',
        'profile',
        'status',
        'phone',
        'email',
    ];
}
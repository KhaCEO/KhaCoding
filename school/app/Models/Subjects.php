<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    protected $fillable = [
        'sub_name',
        'sub_type',
        'sub_create',
        'sub_status',
        'sub_delete',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class,'sub_create' ,'id');
    }
    public function getSubClass()
    {
        return $this->hasMany(AssignSubjecjs::class,'subject_id' ,'id');
    }
}

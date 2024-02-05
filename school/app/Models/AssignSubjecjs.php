<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubjecjs extends Model
{
    use HasFactory;
    protected $table = 'assign_subjecjs';
    protected $fillable = [
        'class_id',
        'subject_id',
        'as_create_by',
        'as_status',
        'as_delete',
    ];

    public function getClass()
    {
        return $this->belongsTo(ClassRoom::class,'class_id' ,'id');
    }
    public function getSub()
    {
        return $this->belongsTo(Subjects::class,'subject_id' ,'id');
    }
    public function getAssBy()
    {
        return $this->belongsTo(User::class,'as_create_by' ,'id');
    }
}

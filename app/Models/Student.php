<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'grade',
        'name',
        'address',
        'img_path',
        'comment',
    ];

    //リレーション追加
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function school_grade()
    {
        return $this->belongsTo(School_grade::class);

    }
}

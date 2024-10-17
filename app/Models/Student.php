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
    public function schoolGrades()
    {
      return $this->hasMany(SchoolGrade::class);
    }
}

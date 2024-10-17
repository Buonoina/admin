<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade',
        'term',
        'japanese',
        'math',
        'science',
        'social_studies',
        'music',
        'home_economics',
        'english',
        'art',
        'health_and_physical_education',
    ];
    public function student()
    {
   
return $this->belongsTo(Student::class);
}
}
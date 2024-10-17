<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School_grade;
use Illuminate\Http\Request;

class School_gradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $school_grades = School_grade::latest()->paginate(5);
            return view('school_grade.index',compact('school_grades'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        $school_grades = School_grade::all();  
           return view('school_grade.create', compact('students', 'school_grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School_grade  $school_grade
     * @return \Illuminate\Http\Response
     */
    public function show(School_grade $school_grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School_grade  $school_grade
     * @return \Illuminate\Http\Response
     */
    public function edit(School_grade $school_grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School_grade  $school_grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School_grade $school_grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School_grade  $school_grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(School_grade $school_grade)
    {
        //
    }
}

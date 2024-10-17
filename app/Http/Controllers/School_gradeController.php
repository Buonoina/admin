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
        
        $school_grades = School_grade::join('grades', 'school_grades.id', '=', 'grades.id')
    

     
        ->join('students', 'grades.id', '=', 'students.id')
   
        ->paginate(5); // Paginate the results

    
        return view('school_grade.index', compact('school_grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

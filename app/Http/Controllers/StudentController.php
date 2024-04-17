<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School_grade;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $students = Student::latest()->paginate(5);
            return view('student.index',compact('students'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_grades = School_grade::all();
            return view('student.create')
        ->with('school_grades',$school_grades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([   
            'grade'=> 'required|integer',
            'name' => 'required|max:20',
            'address' => 'required|max:50',
            'img_path' => 'required',
            'comment' => 'required|max:140',
        ]);
    
        $dir = 'img_paths';

        $path = $request->file('img_path')->store('public/' . $dir);

        $student = new Student;
            $student->grade = $request->input("grade");
            $student->name = $request->input("name");
            $student->address = $request->input("address");
            $student->comment = $request->input("comment");
            $student->img_path = $path;
            $student->save();

            return redirect()->route('students.index')->with("success", '登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $school_grades = school_grade::all();
            return view ('student.show',compact('student'))
            ->with('page_id',request()->page_id)
        ->with('school_grades',$school_grades);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $school_grades = School_grade::all();
            return view ('student.edit',compact('student'))
        ->with('school_grades',$school_grades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([   
            'grade'=> 'required|integer',
            'name' => 'required|max:20',
            'address' => 'required|max:50',
            'img_path' => 'required',
            'comment' => 'required|max:140',
        ]);
    
        if($request->file('img_path')){
            $dir = 'img_paths';
            $path = $request->file('img_path')->store('public/' . $dir);

        }
            $student->grade = $request->input("grade");
            $student->name = $request->input("name");
            $student->address = $request->input("address");
            $student->comment = $request->input("comment");
            $student->img_path = $path;
            $student->save();

        $page = request()->input('page');

        return redirect()->route('products.index', ['page' => $page])
        ->with("success", '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
        ->with("success",$student->name.'を削除しました');
}
}

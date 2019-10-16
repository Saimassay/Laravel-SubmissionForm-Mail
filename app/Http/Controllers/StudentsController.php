<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentsController extends Controller
{
    //
    public function index(Request $request){
    	$order = Order::findOrFail($request->id);
    	Mail::to($mail)->send(new GradeMailer($order));
    // 	 $students = Student::all();
    // return view('students.index', ['students' => $students]);


    }

    public function show(Student $id){
    return view('students.show', ['student' => $id]);

    }
    public function create(){
    	return view('students.create');
    }
    public function store(){
    	$this->validate(request(),[
        'name' => 'required|unique:students',
        'grade' => 'numeric',
    	]);
    	$student = new Student;
    	$student->name = request('name');
    	$student->grade = request('grade');
    	$student->save();

    	return redirect('/students');

    }
}

<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function student_page()
    {
    	//$data = Student::all();
    	//return response()->json($data);
    	return view('student.index');
    }

    public function index()
    {
        // $posts = Student::latest()->paginate(5);
        // return response()->json($posts);
        $data = Student::all();
        return view('student.index', compact('data'));
    }

    public function student_store(Request $request)
    {
    	$data = new Student;
    	$data['name'] = $request->get('name');
    	$data['dob'] = $request->get('dob');
    	$data['phone'] = $request->get('phone');
    	$data->save();
    	return response()->json(['success'=>'Data is successfully added']);
    }

    public function student_edit($id)
    {
    	$data = Student::where('id','=',$id)->first();
    	return view('student.edit', compact('data'));
    }

    public function student_update(Request $request)
    {
    	$data['name'] = $request->get('name');
    	$data['dob'] = $request->get('dob');
    	$data['phone'] = $request->get('phone');
    	$update = Student::where('id','=',$request->get('id'))->update($data);
    	return response()->json(['success'=>'Data is successfully added']);
    	//return redirect('student');
    }

    public function student_delete(Request $request,$id)
    {
    	Student::destroy($id);
    	//return response()->json(['success'=>'Data is successfully Deleted!']);
    	return redirect()->back()->with('success','Data is successfully Deleted!');
    }
}

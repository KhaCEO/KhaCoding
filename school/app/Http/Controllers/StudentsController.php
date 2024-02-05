<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    public function index()
    {
        $students = Students::all();
        return view("student.student", compact('students'));
    }
    public function addStudent(Request $request)
    {
        $studentAcc = new User();
        $studentAcc->name = $request->name;
        $studentAcc->email = $request->email;
        $studentAcc->password = $request->password;
        $studentAcc->save();

        $request->validate([
            'profile' => 'image|mimes:jpeg,png,jpg|dimensions:ratio=1/1',
        ]);
        $studentInfo = new Students();
        $studentInfo->fname = $request->input("fname");
        $studentInfo->lname = $request->input("lname");
        $studentInfo->gender = $request->gender;
        $studentInfo->dob = $request->input("dob");
        $studentInfo->phone = $request->input("phone");
        $studentInfo->email = $request->input("email");
        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $profile = time(). '.' .$extension;
            $file->move('storage/images/',$profile);
            $studentInfo->profile = $profile;
        }
        $studentInfo->save();
        return response()->json([
            'status' => 200,
        ]);
    }
    public function editStudent($id)
    {
        $students = Students::find($id);
        if($students)
        {
            return response()->json([
                'status'    => 200,
                'data'      => $students,
            ]);
        }
    }
    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'profile' => 'image|mimes:jpeg,png,jpg|dimensions:ratio=1/1',
        ]);
        $studentInfo = Students::find($id);
        $studentInfo->fname = $request->input("Upfname");
        $studentInfo->lname = $request->input("Uplname");
        $studentInfo->gender = $request->Upgender;
        $studentInfo->dob = $request->input("Updob");
        $studentInfo->phone = $request->input("Upphone");
        $studentInfo->email = $request->input("Upemail");
        if($request->hasFile('Upprofile')){
            $file = $request->file('Upprofile');
            $extension = $file->getClientOriginalExtension();
            $profile = time(). '.' .$extension;
            $file->move('storage/images/',$profile);
            $studentInfo->profile = $profile;
        }
        $studentInfo->update();
        return response()->json([
            'status' => 200,
        ]);
    }
    public function filterStudent(Request $request)
    {
        $filter_fname = $request->input("filter_fname");
        $filter_lname = $request->input("filter_lname");
        $filter_dob = $request->input("filter_dob");
        $filter_phone = $request->input("filter_phone");
        $filter_gender = $request->input("filter_gender");

        $query = Students::query();
        if($filter_fname)
        {
            $query->where('fname','like','%'.$filter_fname.'%');
        }
        if($filter_lname)
        {
            $query->where('lname','like','%'.$filter_lname.'%');
        }
        if($filter_dob)
        {
            $query->where('dob',$filter_dob);
        }
        if($filter_phone)
        {
            $query->where('phone',$filter_phone);
        }
        if($filter_gender)
        {
            $query->where('gender',$filter_gender);
        }

        $students = $query->get();


        if($students->count() >= 1)
        {
            return view('components.filter.students.filter', compact('students'));
        }
        else
        {
            return response()->json([
                'status'    => 400,
            ]);
        }
    }
}

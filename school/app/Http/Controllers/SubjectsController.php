<?php

namespace App\Http\Controllers;

use App\Models\AssignSubjecjs;
use App\Models\ClassRoom;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectsController extends Controller
{
    public function index()
    {
        $title['title'] = 'Subjects List';
        $subjects = Subjects::all();
        $assSubjects = AssignSubjecjs::orderBy('class_id')->get();
        return view('subjects.subjects', compact('subjects','assSubjects'),$title);
    }
    public function addSubject(Request $request)
    {
        $subjects = new Subjects;

        $subjects->sub_name = $request->input('sub_name');
        $subjects->sub_create = Auth::user()->id;
        $subjects->sub_type = $request->sub_type;

        $subjects->save();
        return response()->json([
            'status'    => 'success',
        ]);
    }
    public function editSubject($id)
    {
        $subjects = Subjects::find($id);
        if($subjects)
        {
            return response()->json([
                'status'    => 200,
                'data'      => $subjects,
            ]);
        }
    }

    public function updateSubject(Request $request, $id)
    {
        $subjects = Subjects::find($id);
        $subjects->sub_name = $request->input('sub_name');
        $subjects->sub_status = $request->input('sub_status');
        $subjects->sub_delete = $request->input('sub_delete');

        $subjects->update();
        return response()->json([
            'status' => 200,
        ]);
    }
    public function assignSubject(Request $request)
    {
        foreach ($request->subject_id as $subjectId)
        {
            $assignSubs = new AssignSubjecjs;
            $assignSubs->class_id = $request->class_id;
            $assignSubs->as_create_by = Auth::user()->id;
            $assignSubs->subject_id = $subjectId;
            $assignSubs->save();
        }
        return response()->json([
            'status'    => 200,
        ]);
    }
    // public function detailSubject()
    // {
    //     $subjects = AssignSubjecjs::find($id)->where('class_id', $id)->get();
    //     // return $subjects;
    //     // return view('components._class.view', compact('subjects'));
    //     if ($subjects)
    //     {
    //         return response()->json([
    //             'status'    => 200,
    //             'data'      => $subjects,
    //         ]);
    //     }
    // }
}

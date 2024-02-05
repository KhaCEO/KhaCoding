<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classRooms = ClassRoom::all();
        $subjects = Subjects::all();
        return view('classRoom.classes', compact('classRooms','subjects'));
    }

    public function addClass(Request $request)
    {
        $classRoom = new ClassRoom;
        $classRoom->cr_name = $request->input('cr_name');
        $classRoom->cr_created_by = Auth::user()->id;

        $classRoom->save();

        return response()->json([
            'status'    => 200,
        ]);
    }

    public function editClass(Request $request, $id)
    {
        $classRoom = ClassRoom::find($id);
        if($classRoom)
        {
            return response()->json([
                'status'    => 200,
                'data'      => $classRoom,
            ]);
        }
    }

    public function updateClass(Request $request, $id)
    {
        $classRoom = ClassRoom::find($id);
        $classRoom->cr_name = $request->input('cr_name');
        $classRoom->cr_status = $request->input('cr_status');
        $classRoom->cr_deleted = $request->input('cr_deleted');

        $classRoom->update();
        return response()->json([
            'status' => 200,
        ]);
    }
    public function filterClass(Request $request)
    {
        $classStatus = $request->filterClass;
        $classRooms =  ClassRoom::where('cr_status','=',$classStatus)->get();

        if($classRooms->count() >= 1)
        {
            return view('components.filter.class.result', compact('classRooms'));
        }
        else
        {
            return response()->json([
                'status'    => 400,
            ]);
        }
    }
}

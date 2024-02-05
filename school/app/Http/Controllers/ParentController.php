<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        $parents = Parents::all();
        return view('parent.parent', compact('parents'));
    }
    public function addParent(Request $request)
    {
        $parentAcc = new User();
        $parentAcc->name = $request->name;
        $parentAcc->email = $request->email;
        $parentAcc->password = $request->password;
        $parentAcc->save();

        $request->validate([
            'profile' => 'image|mimes:jpeg,png,jpg|dimensions:ratio=1/1',
        ]);
        $parentInfo = new Parents();
        $parentInfo->fname = $request->input("fname");
        $parentInfo->lname = $request->input("lname");
        $parentInfo->gender = $request->gender;
        $parentInfo->phone = $request->input("phone");
        $parentInfo->email = $request->input("email");
        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $extension = $file->getClientOriginalExtension();
            $profile = time(). '.' .$extension;
            $file->move('storage/images/',$profile);
            $parentInfo->profile = $profile;
        }
        $parentInfo->save();
        return response()->json([
            'status' => 200,
        ]);
    }
}

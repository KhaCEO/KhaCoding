<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    //
    public function index()
    {
        $users = Crud::all();
        return view('welcome', compact('users'));
    }
    public function add()
    {
        return view('create');
    }
    public function addUser(Request $request)
    {
        $users = new Crud();
        $users->username = $request->input('username');
        $users->email = $request->input('email');
        $users->save();
        return redirect('/');
    }
    public function editUser($id)
    {
        $users = Crud::find($id);
        return view('edit', compact('users'));
    }
    public function updateUser(Request $request, $id)
    {

        $users = Crud::find($id);

        $users->username = $request->input('username');
        $users->email = $request->input('email');


        $users->update();

        return redirect('/');
    }

    public function deleteUser($id)
    {
        Crud::destroy($id);
        return back();
    }
}

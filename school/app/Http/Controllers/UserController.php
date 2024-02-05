<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $title['title'] = 'Users List';
        $users = User::paginate(2);
        return view('users.users', compact('users'), $title);
    }


    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|min:4',
            'email'     => 'required|max:255|email|unique:users',
            'password'  => 'required|min:6'
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages(),
            ]);
        }
        else
        {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->user_role = $request->role;

            $user->save();
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        if($user)
        {
            return response()->json([
                'status'    => 200,
                'data'  => $user,
            ]);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'min:4',
            'email'     => 'required|max:255|email|unique:users,email,'.$request->id,
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages(),
            ]);
        }
        else
        {
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->user_role = $request->role;

            $user->update();
            return response()->json([
                'status' => 200,
            ]);
        }
    }

    public function filterUser(Request $request)
    {
        $userRole = $request->filterUser;
        $users =  User::where('user_role','=',$userRole)->get();

        if($users->count() >= 1)
        {
            return view('components.filter.user.result', compact('users'));
        }
        else
        {
            return response()->json([
                'status'    => 400,
            ]);
        }
    }

    public function searchUser(Request $request)
    {
        $users = User::where('email','=',$request->sEmail)->get();

        if($users->count() >=1)
        {
            return view('components.filter.result', compact('users'));
        }
        else
        {
            return response()->json([
                'status'    => 400,
            ]);
        }
    }


}

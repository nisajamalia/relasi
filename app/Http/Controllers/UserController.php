<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function createUser(Request $request){
        $data = $request->all();

        $user = new User;
        $validator = Validator::make(
            $data, [
                'name'=> 'required|string|max:100',
                'email'=> 'required|email|unique:users,email,',
                'password'=> 'required|string|min:6',

            ]
            );
            if($validator->fails()){
                $error = $validator->errors();
                return response()->json(compact('error'), 500);
            }
            $user->name = $data ['name'];
            $user->email = $data ['email'];
            $user->password = $data ['password'];
            $user->save();

        //masukin data tlpn
        $user->phone()->create([
            'phone'=> $data['phone']
        ]);
        $user->phone;
        $status = "success";
        return response()->json(compact('user', 'status'), 200);
    }

    public function updateUser($id, Request $request){
        $data = $request->all();
        $user = User::findOrFail($id);
        $validator = Validator::make(
            $data, [
                'name'=> 'required|string|max:100',
                'email'=> 'required|email|unique:users,email,'.$id,
                'password'=> 'required|string|min:6',

            ]
            );
            if($validator->fails()){
                $error = $validator->errors();
                return response()->json(compact('error'), 500);
            }
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        $user->phone()->phone = $data['phone'];
        $user->push();
        $user->phone;

        $status = "success";
        return response()->json(compact('user','status'),200);
    }
    public function showUser($id){
        $user = User::findOrFail($id);
        $user->phone;
        $status = "success";
        return response()->json(compact('status','user'),200);
    }
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->phone()-> delete();
        $user->delete();
        $status = "success deleted";
        return response()->json('compact'('status', 'user'),200);
    }
    public function getAllDataUser(User $user){
        $user->phone();
        $status = "success show all data";
        return response()->json(compact('status'), 200);
    }
}
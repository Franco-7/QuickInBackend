<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_number'=>'required|max:10',
            'fname'=>'required|max:50',
            'lname'=>'required|max:50',
            'email'=>'required|email|max:100|unique:users,email',
            'password'=>'required|min:3',
            'phone_number'=>'required|max:10',
            'license'=>'required|max:50',
            'department_id'=>'required|max:5',
        ]);

        if($validator->fails()) {
            return response()->json([
                'validation_errors'=>$validator->messages(),
            ]);
        }
        else {
            $user = User::create([
                'employee_number'=>$request->employee_number,
                'type'=> 1,
                'fname'=>$request->fname,
                'lname'=>$request->lname,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone_number'=>$request->phone_number,
                'license'=>$request->license,
                'department_id'=>$request->department_id,
            ]);

            $token = $user->createToken($user->employee_number.'_Token')->plainTextToken;

            return response()->json([
                'status'=>200,
                'employee_number'=>$request->employee_number,
                'user_type'=>$user->type,
                'token'=>$token,
                'message'=>'User registered seccesfully'
            ]);
        }
    }

    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'employee_number'=>'required|max:10',
            'password'=>'required|min:3',
        ]);

        if($validator->fails()) {
            return response()->json([
                'validator_errors'=>$validator->messages(),
            ]);
        }
        else {
            $user = User::where('employee_number', $request->employee_number)->first();
            if(! $user || ! Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status'=>401,
                    'message'=>'Invalid credentials',
                ]);
            }
            else {
                $token = $user->createToken($user->employee_number.'_Token')->plainTextToken;
                
                return response()->json([
                    'status'=>200,
                    'employee_number'=>$request->employee_number,
                    'user_type'=>$user->type,
                    'token'=>$token,
                    'message'=>'Logged in seccesfully'
                ]);
            }
        }
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Logged out successfully',
        ]);
    }
}

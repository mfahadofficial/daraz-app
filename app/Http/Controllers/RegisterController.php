<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Http\Resources\Product ;



class RegisterController extends BaseController
{
   public function register(Request $request)
    {

        // retur('4');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['role_id'] = "3";
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return response()->json(['token' => $success], 200);
   
        // return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['name'] =  $user->name;
            $success['role_id'] =  $user->role_id;
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 


    }

           public function registeredUser(Request $request)
    {
    
       return response()->json(['name' => 'zahidUser', 'status' => 'User']);


    }

    
    public function vendor(Request $request)
    {
       return response()->json(['name' => 'zahidVendor', 'status' => 'Vendor']);

    }

    public function superAdmin(Request $request)
    {
       return response()->json(['name' => 'zahidSuperAdmin', 'status' => 'SuperAdmin']);

    }





}



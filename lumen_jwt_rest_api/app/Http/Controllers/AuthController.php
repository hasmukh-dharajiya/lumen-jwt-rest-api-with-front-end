<?php

namespace App\Http\Controllers;

use App\Classes\UserClass;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $authManager;
    public function __construct(UserClass $userClass)
    {
        $this->authManager = $userClass;
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ],[
            'name.required' => 'Name Filed is Required',
            'email.required' => 'Email Filed is Required',
            'password.required' => 'Password Filed is Required',
        ]);
        if ($validator->fails()){
            $error = $validator->errors()->first();
            return response()->json(['status'=>false,'message'=>$error])->setStatusCode(400);
        }
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        return $this->authManager->register($name,$email,$password);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'email' => 'required|string',
                'password' => 'required|min:8',
            ],[
                'email.required' => 'Email Field is Required!',
                'password.required' => 'password Field is Required!'
            ]);
            if ($validator->fails()){
                $error = $validator->errors()->first();
                return response()->json(['status'=>false,'message'=>$error])->setStatusCode(400);
            }
            $email = $request->email;
            $password = $request->password;
            return $this->authManager->login($email,$password);
        }catch (\Exception $exception){
            return response()->json(['status'=>false,'message'=>'Authentication Failed !',"error"=>$exception->getMessage()])->setStatusCode(400);
        }
    }


}

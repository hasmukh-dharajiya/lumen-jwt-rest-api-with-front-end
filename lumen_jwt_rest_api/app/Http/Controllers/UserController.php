<?php

namespace App\Http\Controllers;

use App\Classes\UserClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $user;

    public function __construct(UserClass $user)
    {
        $this->user = $user;
    }
    public function changePassord(Request $request){
        $validator = Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error])->setStatusCode(400);
        }
        $email = Auth::user()->email;

        return $this->user->changePassord($email,$request->current_password,$request->new_password);
    }
    public function logout(Request $request)
    {
        $token = $request->token;
        if (Auth::invalidate($token)) {
            return response()->json([
                'status' => true,
                'message' => 'User has been logged out'
            ]);
        }
    }
}

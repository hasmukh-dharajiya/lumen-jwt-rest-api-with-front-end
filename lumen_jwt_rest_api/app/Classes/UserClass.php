<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserClass
{
    private $userManager;

    public function __construct(User $user)
    {
        $this->userManager = $user;
    }

    public function register($name, $email, $password)
    {
        try {
            if ($this->userManager->checkUser($email)) {
                return response()->json(['status' => false, 'message' => "user Already Exit !"])->setStatusCode(400);
            }
            $hash_password = Hash::make($password);
            $result = $this->userManager->register($name, $email, $hash_password);
            if ($result) {
                $userDetail = array();
                $userDetail['email'] = $email;
                $userDetail['password'] = $password;
                $token = Auth::attempt($userDetail);
                if ($token) {
                    return response()->json(['status' => true, 'message' => "user register success!", "token" => $token])->setStatusCode(200);
                }
            }
            return response()->json(['status' => false, 'message' => "error while register user!"])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("UserClass Error", ["register" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(["status" => false, "message" => "internal server Error"])->setStatusCode(500);
        }
    }

    public function login($email, $password)
    {
        try {
            $userDetail = array();
            $userDetail['email'] = $email;
            $userDetail['password'] = $password;
            $token = Auth::attempt($userDetail);
            if ($token) {
                return response()->json(['status' => true, 'message' => "user login success!", "token" => $token])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => "Invalid Credential!"])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("UserClass Error", ["login" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(["status" => false, "message" => "internal server Error"])->setStatusCode(500);
        }
    }

    public function changePassord($email,$current_password,$new_password){
        try {
            $email = $this->userManager->getSingleUser($email);
            if (isset($email) && !empty($email)){
                if (Hash::check($current_password, $email->password)){
                    $update = $this->userManager->updatePassword($email, Hash::make($new_password));
                    if ($update){
                        return response()->json(['status' => true, 'message' => 'password change success'])->setStatusCode(200);
                    }
                }
            }
            return response()->json(['status' => false, 'message' => 'error while reset password'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info('UserClass Error', ['resetPassword' => $ex->getMessage(), 'line' => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
}

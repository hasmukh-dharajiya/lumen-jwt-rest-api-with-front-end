<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Auth\Authorizable;


use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $fillable = [
        'name', 'email'
    ];
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function checkUser($email)
    {
        try {
            $result = $this->where("email", $email)->first();
            if ($result) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info("UserModel Error", ["register" => $ex->getMessage(), "line" => $ex->getLine()]);
            return false;
        }
    }

    public function register($name, $email, $password)
    {
        try {
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            if ($this->save()) {
                return true;
            }
            return false;
        } catch (QueryException $ex) {
            Log::info("UserModel Error", ["register" => $ex->getMessage(), "line" => $ex->getLine()]);
            return false;
        }
    }

    public function getSingleUser($email){
        try {
            $user_email = $this->where('email',$email)->first();
            if ($user_email){
                return $user_email;
            }
            return null;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['getSingleUser'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return null;
        }
    }
    public function updatePassword($email,$hashPassword){
        try {
            $result = $this->where('email',$email)
                ->update(['password'=>$hashPassword]);
            if ($result){
                return true;
            }
            return false;
        }catch (QueryException $ex){
            Log::info('UserModel Error',['resetPassword'=>$ex->getMessage(),'line'=>$ex->getLine()]);
            return false;
        }
    }
}

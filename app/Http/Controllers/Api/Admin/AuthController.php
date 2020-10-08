<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralTrait;
use Validator;

class AuthController extends Controller
{
    //

    use GeneralTrait;

    public function login(Request $request)
    {

        //==============validation is used in any api project its very professional and important=============

        try{
            $rules =
            [
                'email' => 'required|exists:admins,email',
                'password' => 'required'
            ];
            $validator = Validator::make($request->all() , $rules);

            if($validator->fails())
            {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }


            //=====================login=========================

            //$credentials = request(['email', 'password']);
            $credentials = $request->only(['email', 'password']);

            $token = auth('admin-api')->attempt($credentials);
            if (! $token ) 
            {
                return $this->returnErrors('E001', 'Unauthorized'); 
            }

            $admin = Auth::guard('admin-api')->user();
            $admin->api_token = $token ;
            //return $this->respondWithToken($token);
            return $this->returnData('admin', $admin); 
  

        } catch (\Exception $e) {
                
            return $this->returnErrors( $e->getCode(), $e->getMessage());
           
        }



    }//endloginfunction




}

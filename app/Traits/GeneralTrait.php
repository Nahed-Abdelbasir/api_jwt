<?php

namespace App\Traits;

trait  GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }


    public function returnErrors($error , $msg)
    {
        return response()->json(
            [
                'status' => false,
                'error' =>  $error,
                'msg' => $msg
            ]
        );
    }


    public function returnSuccessMessage( $msg = '' ,$error = 'E001')
    {
        return response()->json(
            [
                'status' => true,
                'error' =>  $error,
                'msg' => $msg
            ]
        );
    }


    public function returnData($key , $value , $msg = '')
    {
        return response()->json(
            [
                'status' => true,
                'error' =>  'E001',
                'msg' => $msg ,
                 $key =>  $value 
            ]
        );
    }


    public function getErrorCode($input)
    {
        if($input == 'name')
        {
            return 'E001';

        }elseif($input == 'email')
        {
            return 'E002';

        } elseif($input == 'password')
        {
            return 'E003';

        }elseif($input == 'mobile')
        {
            return 'E004';
        }else 
        {
            return "";
        }
        
    }


    public function returnValidationError($code = 'E001', $validator)
    {
        return $this->returnErrors($code , $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }
    

}
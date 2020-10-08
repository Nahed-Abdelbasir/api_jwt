<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{

    use GeneralTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            
            if($e instanceof \Tymon\JWTAuth\exception\TokenInvalidException)
            {
                return $this->returnErrors( 'E3001', 'Invalid_Token');

            }elseif ($e instanceof \Tymon\JWTAuth\exception\TokenExpiredException) {

                return $this->returnErrors( 'E3001', 'Expired_Token');

            }else {
                
                return $this->returnErrors( 'E3001', 'Token_Not_Found');

            }
        }catch (\Throwable $e) {
            
            if($e instanceof \Tymon\JWTAuth\exception\TokenInvalidException)
            {
                return $this->returnErrors( 'E3001', 'Invalid_Token');

            }elseif ($e instanceof \Tymon\JWTAuth\exception\TokenExpiredException) {

                return $this->returnErrors( 'E3001', 'Expired_Token');

            }else {
                
                return $this->returnErrors( 'E3001', 'Token_Not_Found');

            }
        }

        if(!$user)
        {
            return $this->returnErrors( 'E3001', 'Unauthenticated');
        }

        return $next($request);
    }
}

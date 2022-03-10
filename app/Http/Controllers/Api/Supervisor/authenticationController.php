<?php

namespace App\Http\Controllers\Api\Supervisor;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupervisorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class authenticationController extends Controller
{
        public function authenticate(Request $request){

            $validator = Validator::make($request->all(), [
                'email' => 'required|exists:supervisors,email',
                'password' => 'required|string',
                'mobile_token'=>'nullable|string',

            ]);

            if($validator->fails()){
                return response()->json([
                    'status'  => false,
                    'errors' =>$validator->errors(),
                ], 404);
            }

            $credentials = ['email' => $request->email, 'password' => $request->password];


            try {
                if (! $token = auth('supervisor')->attempt($credentials)) {
                    return response()->json([
                        'status'  => false,
                        'message' =>__('site.password or email is wrong') ,
                    ], 404);
                }
            } catch (JWTException $e) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.some thing is wrong' ),
                ], 404);
            }

            $supervisor= auth('supervisor')->user();
            if($supervisor->block=='block')
            {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.Your Account Is Blocked'),
                ], 404);
            }
            if($request->mobile_token != null){
                $supervisor->update(['mobile_token'=>$request->mobile_token]);
            }
            return response()->json([
                    'status'  => true,
                    'supervisor'=> new SupervisorResource($supervisor),
                    'token'   => $token,
                ], 200);
    }

        public function logout(Request $request){
            $supervisor= auth('supervisor')->user();

            $supervisor->update(['mobile_token'=>null]);

            Auth::guard('supervisor')->logout('true');

            return response()->json([
                'status'  => true,
                'message' => __('site.Logout Successfully'),
            ], 200);          }
}

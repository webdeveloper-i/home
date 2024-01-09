<?php

namespace App\Http\Controllers\Crm;

use App\Models\Crm\PermissionGroup;
use App\Models\User;
use App\Http\Controllers\Controller;

use App\Mail\VerifyMail;
use App\Rules\ExistsUser;
use Carbon\Carbon;
use App\Http\Controllers\Resources\FileController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    /**
     * Login
     * @param Request $request
     * @return mixed
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:20',
            'password' => 'required|string|max:255'
        ]);

        if ($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

        if (!$token = auth('api')->attempt(['username' => $request->username, 'password' => $request->password, 'status' => User::STATUS_ACTIVE, 'role' => User::ROLE_ADMIN])) {
            return $this->errorResponse('The credentionals error', 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header('Authorization');
        // Invalidate the token
        try {
            auth('api')->invalidate($token);
            return $this->successResponse('Successfully logged out');
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->errorResponse('Failed to logout, please try again.', 500);
        }
    }


    public function refresh()
    {
        $access_token = auth('api')->refresh(true,true);
        auth()->setToken($access_token);

        return $this->respondWithToken($access_token);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255', new ExistsUser(User::ROLE_ADMIN)],
        ]);

        if ($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

        $field =  'username';

        $user = User::where([[$field, $request->username], ['role', User::ROLE_ADMIN]])->first();

        if($user->status != User::STATUS_ACTIVE)
            return $this->errorResponse('This administrator is inactive.', 422);

        $verify_code = Str::random(60);
        $user->update([
            'verify_code' => $verify_code,
            'verify_code_expire' => Carbon::now()->addSeconds(User::VERIFY_TIME)
        ]);

        $result = 'Successfully send sms';
        return $this->successResponse($result);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verify_code' => 'required|string|max:255',
            'password' => 'min:6|string|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

        $user = User::where('verify_code', $request->verify_code)->first();
        if(!$user || $user->verify_code_expire > date('Y-m-d H:i:s'))
            return $this->errorResponse("Verification code error.", 401);

        $user->update([
            'verify_code' => NULL,
            'verify_code_expire' => NULL,
            'password' => bcrypt($request->password)
        ]);

        $result = 'Password successfully changed';
        return $this->successResponse($result);
    }

    protected function respondWithToken($access_token)
    {
        return $this->successResponse([
            'access_token' => $access_token,
            'token_type' => 'bearer',
            'access_expires_in' => auth()->factory()->getTTL() ,
            'refresh_token' => auth()
                ->claims([
                    'xtype' => 'refresh',
                    'xpair' => auth()->payload()->get('jti')
                ])
                ->setTTL(auth()->factory()->getTTL() * 24)
                ->tokenById(auth()->user()->id),
            'refresh_expires_in' => auth()->factory()->getTTL()*1
        ]);
    }

    private static function str_random($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

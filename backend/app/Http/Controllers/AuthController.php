<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\BaseController as BaseController;

class AuthController extends BaseController
{
    protected $accessTokenDateTime;
    protected $refreshTokenDateTime;

    public function __construct()
    {
        $this->accessTokenDateTime = Carbon::now()->addMinutes(1);
        $this->refreshTokenDateTime = Carbon::now()->addMinutes(5);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(6)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::beginTransaction();
        try {
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $token = $this->token($user);
            $response = ['user' => $user, 'access_token' => $token['access_token'], 'refresh_token' => $token['refresh_token']];

            DB::commit();
            return $this->sendResponse($response, 'User registration successfully.', 201);
        } catch (Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();
            return $this->sendError('Internal server error.', $error, 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password'  => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->sendResponse($this->getToken(), 'User login successfully.');
        } else {
            return $this->sendError('The provided credentials are incorrect.', '', 401);
        }
    }

    public function refresh()
    {
        $user = Auth::user();
        if ($user->tokenCan('refresh')) {
            return $this->sendResponse($this->getToken(), 'Token refreshed successfully!');
        }
        return $this->sendError('Invalid refresh token!', '', 401);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse('', 'Successfully Logged Out !!');
    }

    public function tokenStatus()
    {
        $currentToken = auth()->user()->currentAccessToken();
        $tokenExpireTime = $currentToken->expires_at;

        if ($tokenExpireTime >= Carbon::now()) {
            return true;
        }
        return false;
    }

    private function getToken()
    {
        Auth::user()->tokens()->delete();
        $user = Auth::user();
        $token = $this->token($user);

        return ['user' => $user, 'access_token' => $token['access_token'], 'refresh_token' => $token['refresh_token']];
    }

    private function token($user)
    {
        $accessTokenDateTime = $this->accessTokenDateTime;
        $refreshTokenDateTime = $this->refreshTokenDateTime;
        $access_token = $user->createToken('accessToken', ['access'], $accessTokenDateTime)->plainTextToken;
        $refresh_token = $user->createToken('refreshToken', ['refresh'], $refreshTokenDateTime)->plainTextToken;

        return ['access_token' => $access_token, 'refresh_token' => $refresh_token];
    }
}

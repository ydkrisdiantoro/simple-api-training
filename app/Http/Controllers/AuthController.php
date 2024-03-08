<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\UserResource;
use App\Jobs\sendWaNotification;
use App\Models\User;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;

class AuthController extends Controller
{
    use ApiResponseHelpers;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->all());
        $respond['result'] = new UserResource($user);
        $respond['message'] = 'User Created';

        return $this->respondCreated($respond);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // sendWaNotification::dispatch($credentials['email'].' login.');

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $data = auth()->user();
        $respond['result'] = UserResource::class($data);
        return response()->json($respond);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'result' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ],
            'message' => 'Success'
        ]);
    }

    public function user()
    {
        $data = new UserResource(
            auth()->user()
        );

        return response()->json($data);
    }
}

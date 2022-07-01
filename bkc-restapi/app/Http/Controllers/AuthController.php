<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);
		
        if (! $token = auth()->attempt($credentials)) {
            
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

        
    }

    public function register(Request $request)
    {
        //validate incoming request 
       
        $this->validate($request, [
            'username' => 'required|string|unique:users',
            'password' => 'required|confirmed',
        ]);

        try 
        {
           
            $data = User::where('USER_ID' , $request->userid)->update(
                [
                    'username' => $request->username,
                    'password' => app('hash')->make($request->password),
                    'created_at' => Carbon::now()
                ]
            );
            

            return response()->json( [
                        'entity' => 'users', 
                        'action' => 'create', 
                        'result' => 'success'
            ], 201);

        } 
        catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => $e, 
                       'action' => 'create', 
                       'result' => 'failed'
            ], 409);
        }
    }

    // public function login(Request $request){

        // $validated = $this->validate($request,[
            // 'username'     => 'required',
            // 'password'     => 'required'
        // ]);

        
        // try {
			
			// dd(sha1(strtoupper($validated['password'])));
            // $user = User::where(
					// [
						// 'username' => $validated['username'],
                        // 'password' => sha1(strtoupper($validated['password'])
					// )])
                    // ->first();
            
            // if(!$user){
                // return response()->json(['message' => 'username atau password salah.']);
            // }

        // } catch (Throwable $e) {
    
            // return response()->json('koneksi bermasalah.');
        // }

        
       
        // $payload = [
            // 'iat' => intval(microtime(true)),
            // 'exp' => intval(microtime(true)),
            // 'uid' => $user->USER_ID
        // ];
        
        // $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        // return $this->respondWithToken($token);

    // }

    public function me()
    {
        return response()->json([
            "profile" => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


}

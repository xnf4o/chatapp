<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ChatApp;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $chatApp = new ChatApp();
        $token = $chatApp->makeToken($request->email, $request->password);
        if(!$token->success)
        {
            return redirect()->back()->withErrors(["email" => $token->error->message]);
        }

        // create user if not exists
        $user = User::where('email', $request->email)->first();
        if(!$user)
        {
            $user = new User();
            $user->name = $request->email;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->chatapp_access_token = $token->data->accessToken;
            $user->chatapp_access_token_end_time = $token->data->accessTokenEndTime;
            $user->chatapp_refresh_token = $token->data->refreshToken;
            $user->chatapp_refresh_token_end_time = $token->data->refreshTokenEndTime;
            $user->save();
        }

        // login
        if(auth()->attempt(['email'=>$request->email, 'password'=>$request->password], true))
        {
            return redirect()->intended(route('home'));
        }

        return redirect()->back()->withInput($request->only('email','remember'));
    }
}

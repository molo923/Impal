<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
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
    protected $redirectTo = '/home';

    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*dd(User::where('email', 'andihabild1004@gmail.com')->get()->toArray());*/

        $this->middleware('guest')->except('logout');

        $this->username = $this->findUsername();
    }

    public function username()
    {
        return $this->username;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login-matrix');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            $this->guard()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            if ($request->ajax()) {
                return response()->json([
                    'token' => csrf_token(),
                    'status' => 'Akun anda belum diverifikasi, silahkan cek email anda.',
                    'email' => $user->email,
                ]);
            }

            return redirect(route('login'))->with([
                'status' => 'Akun anda belum diverifikasi, silahkan cek email anda.',
                'email' => $user->email,
            ]);
        }

        if ($user->status_id === config('constants.statuses.NONAKTIF')) {
            $this->guard()->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            if ($request->ajax()) {
                return response()->json([
                    'token' => csrf_token(),
                    'status' => 'Akun anda belum disetujui admin.'
                ]);
            }

            return redirect(route('login'))->with([
                'status' => 'Akun anda belum disetujui admin.'
            ]);
        }

        $this->storeLastLoginTimestamp($user);

        auth()->logoutOtherDevices(request('password'));

        $redirectUrl = '';

        if ($user->username === 'admin') {
            /*$this->redirectTo = route('admin.index');
            return;*/
            $redirectUrl = route('admin.index');
        }

        if ($user->banksampah || ($user->pegawai && $user->pegawai->type !== 'driver')) {
            /*$this->redirectTo = route('banksampah.dashboard');
            return;*/
            $redirectUrl = route('banksampah.dashboard');
        }

        if ($user->pegawai && $user->pegawai->type === 'driver') {
            /*$this->redirectTo = route('driver.index');
            return;*/
            $redirectUrl = route('driver.index');
        }

        if ($request->ajax()) {
            return response()->json([
                'url' => $redirectUrl,
            ]);
        }

        return redirect($redirectUrl);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user());
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    protected function loggedOut(Request $request)
    {
        return redirect(route('login'));
    }

    private function storeLastLoginTimestamp($user)
    {
        $user->last_login = now();
        $user->save();
    }

}

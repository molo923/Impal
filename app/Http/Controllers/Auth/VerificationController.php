<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/banksampah';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('resend', 'verify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->id);

        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        if ($user->pegawai) {

            $user->forceFill([
                'activated_at' => now(),
            ])->save();

            if ($request->ajax()) {
                return response()->json([
                    'pegawai_verified' => true,
                ]);
            }

            return redirect(route('login'))->with('pegawai_verified', true);
        }

        if ($request->ajax()) {
            return response()->json([
                'verified' => true,
            ]);
        }

        return redirect(route('login'))->with('verified', true);
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->email)->get()->first();

        /*if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }*/

        $user->sendEmailVerificationNotification();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'Link verifikasi email telah dikirim, silahkan cek email anda.',
            ]);
        }

        return back()->with('status', 'Link verifikasi email telah dikirim, silahkan cek email anda.');
    }
}

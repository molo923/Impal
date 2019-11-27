<?php


namespace App\Http\Controllers\Auth\Banksampah;

use App\Alamat;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.banksampah.register-matrix');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'banksampahName' => ['required', 'string', 'max:50', 'min:3'],
            'username' => ['required', 'string', 'max:20', 'unique:users', 'regex:/^[a-zA-Z0-9_]*$/'],
            'email' => ['required', 'email', 'max:255', 'min:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[0-9])(?=.*[\d\X]).*$/'],
            'phone_number' => ['required', 'numeric', 'unique:users', 'digits_between:8,15'],
            'alamat' => ['required', 'string', 'min:3', 'max:70'],
            'city' => 'required',
            'districts' => 'required',
            'urban' => 'required',
            /*'postal_code' => 'required|numeric|digits:5',*/
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => strtolower($data['username']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'status_id' => config('constants.statuses.NONAKTIF')
        ]);

        $user->alamat()->associate(Alamat::create([
            'address' => $data['alamat'],
            'city' => $data['city'],
            'districts' => $data['districts'],
            'urban' => $data['urban'],
            'postal_code' => $data['postal_code'],
        ]));

        $user->banksampah()->create([
            'name' => $data['banksampahName'],
            'status_id' => config('constants.statuses.BRONZE'),
        ]);

        $user->save();

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        if (!$user->hasVerifiedEmail()) {
            $this->guard()->logout();

            $request->session()->invalidate();

            if ($request->ajax()) {
                return response()->json([
                    'url' => route('login'),
                    'status' => 'Akun anda belum diverifikasi, silahkan cek email anda.',
                    'email' => $user->email,
                ]);
            }

            return redirect(route('login'))->with([
                'status' => 'Akun anda belum diverifikasi, silahkan cek email anda.',
                'email' => $user->email,
            ]);
        }
    }
}

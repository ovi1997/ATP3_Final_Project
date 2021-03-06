<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contactNo' => ['required', 'string'],
            'address' => ['required', 'string'],
            'userType' => ['required'],
            'image' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($file = $request->file('image')) {

            $extension = $file->getClientOriginalExtension();
            $name = md5($file->getClientOriginalName() . time()) . "." . $extension;
            $file->move(public_path('uploads'), $name);

            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'contactNo' => $request['contactNo'],
                'address' => $request['address'],
                'userType' => $request['userType'],
                'image' => $name,
                'password' => Hash::make($request['password']),
            ]);
            return redirect()->route('login');
        }
    }
}

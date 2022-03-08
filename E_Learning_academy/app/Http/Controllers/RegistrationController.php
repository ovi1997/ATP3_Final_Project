<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
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

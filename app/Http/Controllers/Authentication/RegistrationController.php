<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Events\UserRegistered;

class RegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('authentication.registration');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(Request $request)
    {


        //validate
        $this->validate(
            $request,
            [
                'email' => 'required|unique:users|email:rfc,dns',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone' => 'required|max:30',
                'city' => 'required|max:255',
                'password' => [
                    'required',
                    'confirmed',
                    Password::min(4)
                ],
            ]
        );
//        dd($request);
        //create user
        $user = User::create([
            'email' => $request['email'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'city' => $request['city'],
            'password' => Hash::make($request['password']),
        ]);


        UserRegistered::dispatch($user);

        //login user
        auth()->attempt($request->only('email', 'password'));

        //redirect

        return redirect()->route('dashboard');
//        return redirect()->route('home')->middleware('auth');

    }
}

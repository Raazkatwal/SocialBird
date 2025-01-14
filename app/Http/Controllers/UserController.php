<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(Request $r)
    {
        $r->validate([
            'name' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'day' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|numeric',
        ], [
            "name.required" => "Username is required",
            "name.unique" => "The Username has already been taken",
            "email.email" => "Invalid Email address",
            "email.unique" => "The Email has already been taken",
        ]);

        // Convert the day, month, and year into a valid date format using Carbon
        $date_of_birth = Carbon::create($r->year, array_search($r->month, [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ]) + 1, $r->day);


        $user = User::create([
            'username' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'date_of_birth' => $date_of_birth,
        ]);

        Auth::login($user, true);
        return redirect()->route('home');
    }

    public function login(Request $r)
    {
        $r->validate([
            'email_or_username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $r->email_or_username)
            ->orWhere('username', $r->email_or_username)
            ->first();

        if (!$user) {
            return back()->withErrors(['email_or_username' => 'The provided Email or Username does not exist.']);
        }
        if (!Hash::check($r->password, $user->password)) {
            return back()->withErrors(['password' => 'The provided password is incorrect.']);
        }

        $credentials = [
            'password' => $r->password,
        ];

        //checks if username is given or email is given in the form
        if (filter_var($r->email_or_username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $r->email_or_username;
        } else {
            $credentials['username'] = $r->email_or_username;
        }


        if (Auth::attempt($credentials, $r->filled('remember'))) {
            return redirect()->route('home');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}

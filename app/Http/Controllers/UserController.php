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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'day' => 'required|numeric',
            'month' => 'required|string',
            'year' => 'required|numeric',
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

        $credentials = [
            'password' => $r->password,
        ];
    
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

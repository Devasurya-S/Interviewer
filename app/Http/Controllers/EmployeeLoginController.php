<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employees;

class EmployeeLoginController extends Controller
{
    public function doLoginEmployee(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $input = [
            'email' => $email,
            'password' => $password,
        ];

        if (auth('employee')->attempt($input, true)) {
            return redirect()->route('answer.group');
        } else {
            return redirect()->route('employee.login')->with('message', 'Login is Invalid');
        }
    }

    public function doLoginUser(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        $input = [
            'email' => $email,
            'password' => $password,
        ];

        if (auth()->attempt($input, true)) {
            return redirect()->route('candidate.home');
        } else {
            return redirect()->route('login.page')->with('message', 'Login is Invalid');
        }
    }

    public function doLogoutEmployee(){
        auth()->logout();
        return redirect()->route('employee.login');
    }

    public function doLogoutUser(){
        auth()->logout();
        return redirect()->route('login.page');
    }
}

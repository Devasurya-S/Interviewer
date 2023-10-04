<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function loginPage() {
        return view('Users/login');
    }

    public function signUpPage() {
        return view('Employees/signup');
    }

    public function employeeLogin() {
        return view('Employees/login');
    }

    public function answerGroups() {
        return view('Employees/answerGroups');
    }

    public function interviewAddPage() {
        return view('Employees/addInterview');
    }

    public function candidateAddPage() {
        return view('Employees/addCandidate');
    }

}
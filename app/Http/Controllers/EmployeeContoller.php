<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Employees;

class EmployeeContoller extends Controller
{
    private $id;

    public function __construct()
    {
        if (Auth::check()) {
            // Set $id only if the user is authenticated.
            $this->id = Auth::id();
        }
    }

    // Employee SignUp
    public function signUp(Request $request)
    {
        $validator = $this->validateEmployeeData($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $hashedPassword = Hash::make($password);
        $mobile = $request->input('mobile');

        Employees::create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'mobile' => $mobile,
        ]);

        return redirect()->route('login.page');
    }

    // View Employee Details
    public function viewData()
    {
        $employee = Employees::find($this->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found');
        }

        return view('employee.view', ['employee' => $employee]);
    }

    // Employee Update Details
    public function updateData(Request $request)
    {
        $validator = $this->validateEmployeeData($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $employee = Employees::find($this->id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found');
        }

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $password = $request->input('password');
        $employee->password = Hash::make($password);
        $employee->mobile_number = $request->input('mobile');
        $employee->save();

        return redirect()->route('employee.details')->with('success', 'Employee data updated successfully');
    }

    //Delete Employee Account
    public function deleteEmployee($id)
    {
        $employee = Employees::find($id);

        if (!$employee) {
            return redirect()->back()->with('error', 'Employee not found');
        }

        // Can add additional checks here, such as ensuring the currently authenticated user has permission to delete this employee.

        $employee->delete();

        return redirect()->route('employee.signup')->with('success', 'Employee deleted successfully');
    }

    protected function validateEmployeeData(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees,email'],
            'mobile' => ['required', 'string', 'max:20'],
        ];

        // Only add the password validation rules if the password is not null
        if ($data['password'] !== null) {
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];
        }

        // Only add the unique email rule with an exception if $this->id is not null
        // if ($this->id !== null) {
        //     $rules['email'][] = Rule::unique('employees')->ignore($this->id);
        // }

        return Validator::make($data, $rules)->setAttributeNames([
            'name' => 'Employee Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'mobile' => 'Mobile Number',
        ]);
    }
}

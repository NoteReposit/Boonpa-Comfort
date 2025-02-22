<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // 🔹 Register Customers
    public function registerCustomer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'user_name' => 'required|string|max:50|unique:customers',
            'email' => 'required|string|email|max:100|unique:customers',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20|unique:customers',
            'address' => 'nullable|string|max:255',
        ]);

        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $customer], 201);
    }

    // 🔹 Register Employees
    public function registerEmployee(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'user_name' => 'required|string|max:50|unique:employees',
            'email' => 'required|string|email|max:100|unique:employees',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:20|unique:employees',
        ]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        $token = $employee->createToken('employee-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $employee], 201);
    }

    // 🔹 Login Customers
    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages(['email' => 'Invalid credentials']);
        }

        $token = $customer->createToken('customer-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $customer]);
    }

    // 🔹 Login Employees
    public function loginEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            throw ValidationException::withMessages(['email' => 'Invalid credentials']);
        }

        $token = $employee->createToken('employee-token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => $employee]);
    }

    // 🔹 Logout (Customers & Employees)
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    // 🔹 Get Current Authenticated User
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}


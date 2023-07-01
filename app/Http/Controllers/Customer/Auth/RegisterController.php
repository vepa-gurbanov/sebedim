<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    public function create() {
        return view('customer.auth.register');
    }


    public function store(Request $request) {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'integer', 'between:60000000, 65999999', !'exists:customers.phone'],
        ]);

        if (!Customer::create([
            'name' => $credentials['name'],
            'phone' => $credentials['phone_number'],
            'password' => Crypt::encryptString($credentials['phone_number']),
        ])) {
            $data = ['error' => 'Problem with creating your account. Try again please!'];
            return to_route('register')->with($data);
        }
        Verification::updateOrCreate(
            ['phone' => $credentials['phone_number']],
            ['code' => rand(10000, 99999), 'status' => 0, 'expires_at' => now()->addMinutes(10)]
        );

        $data = [
            'success' => 'Account created successfully! Verification code sent. Verify your account!',
        ];
        return to_route('verify', ['token' => Crypt::encryptString($credentials['phone_number'])])
            ->with($data);
    }
}

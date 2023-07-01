<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function create() {
        return view('customer.auth.login');
    }


    public function store(Request $request) {
        $credentials = $request->validate([
            'phone_number' => ['required', 'integer', 'between:60000000, 65999999'],
        ]);
        Customer::where('phone', $credentials['phone_number'])->firstOr(function () {
            $data = ['error' => 'Sorry, you don\'t have account yet. Try creating an account!'];
            return to_route('register')->with($data);
        });
        Verification::updateOrCreate(
            ['phone' => $credentials['phone_number']],
            ['code' => rand(10000, 99999), 'status' => 0, 'expires_at' => now()->addMinutes(10)]
        );

        $data = [
            'success' => 'Verification code sent!',
        ];
        return to_route('verify', ['token' => Crypt::encryptString($credentials['phone_number'])])
            ->with($data);
    }


    public function destroy(Request $request)
    {
        Auth::guard('customer_web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route(RouteServiceProvider::__HOME);
    }
}

<?php

namespace App\Http\Controllers\Customer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class VerificationController extends Controller
{
    public function create($token) {
        try {
            $phone = Crypt::decryptString($token);
        } catch (DecryptException $e) {
            session()->flash('error', $e->getMessage());
        }

        $data = [
            'phone' => $phone,
            'token' => $token,
        ];
        return view('customer.auth.verify')
            ->with($data);
    }


    public function store(Request $request, $token) {
        try {
            $phone = Crypt::decryptString($token);
        } catch (DecryptException $e) {
            $data = [
                'error' => $e->getMessage(),
            ];
            return back()->with($data);
        }

        $credentials = $request->validate([
            'code' => ['required', 'integer', 'between:10000, 99999'],
        ]);

        $verification = Verification::where('phone', $phone)->firstOrFail();
        if ($verification->code === $credentials['code'] && $verification->expires_at >= now()) {
            $verification->status = 1;
            $verification->update();
            Auth::guard('customer_web')->login(Customer::where('phone', $phone)->firstOrFail());
            return to_route(RouteServiceProvider::__HOME);
        } elseif ($verification->expires_at < now()) {
            $data = [
                'error' => 'Code expired. Try resend!',
            ];
            return back()->with($data);
        } elseif ($verification->code !== $credentials['code'] && $verification->expires_at >= now()) {
            $data = [
                'error' => 'Code incorrect. Try again!',
            ];
            return back()->with($data);
        }
    }
}

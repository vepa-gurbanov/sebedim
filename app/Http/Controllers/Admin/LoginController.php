<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('admin.auth.login');
    }


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            abort(404);
        }

        if ($this->is_connected()) {
            $user->sendAdminOtpNotification($user);
            $data = [
                'success' => 'Verification code sent!',
            ];
            return to_route('admin.auth.verify', ['id' => $user->id])
                ->with($data);
        } else {
            $data = [
                'error' => 'No internet connection!',
            ];
            return back()
                ->with($data);
        }

//        try {
//        $user->sendAdminOtpNotification($user);
//        } catch (\Exception $e) {
//            dd($e->getCode());
//        }
    }


    public function verification($id)
    {
        return view('admin.auth.verify', ['id' => $id]);
    }


    public function verify(Request $request, $id)
    {
        $credentials = $request->validate([
            'otp_code' => ['required', 'integer', 'between:10000,99999'],
        ]);

        $otp = intval($credentials['otp_code']);
        $user = User::findOrFail($id);

        if( $user->verifyOtp($user, $otp) )
        {
            Auth::guard('web')->login($user);
            return to_route(RouteServiceProvider::__DASHBOARD);
        } elseif ( $user->otp_code !== $otp ) {
            return back()->with([
                'error' => 'OTP Incorrect!',
            ]);
        } elseif ( $user->otp_expires_at <= now() ) {
            $data = [
                'error' => 'OTP Expired!',
            ];
            return to_route('admin.auth.login')
                ->with($data);
        }
    }


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('admin.auth.login');
    }

    function is_connected()
    {
        $connected = @fsockopen("www.example.com", 443);
        //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;
    }
}

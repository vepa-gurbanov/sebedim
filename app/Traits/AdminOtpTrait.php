<?php
/**
 * Created by PhpStorm.
 * User: tazes
 * Date: 5/26/2023
 * Time: 9:37 AM
 */

namespace App\Traits;

use App\Models\User;
use App\Notifications\AdminOtpNotification;


trait AdminOtpTrait
{
    public function nullOtp(User $user) {
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();
        return $user;
    }

    public function generateOtp(User $user): string
    {
        $otp = rand(10000, 99999);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();
        return $otp;
    }


    public function verifyOtp(User $user, $otp): bool
    {
        if ($user->otp_code === $otp && $user->otp_expires_at > now()) {
            $user->password = bcrypt($user->otp_code);
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            return true;
        }
        return false;
    }


    public function sendAdminOtpNotification(User $user): void
    {
        $this->generateOtp($user);
        $this->notify(new AdminOtpNotification($user));
    }
}

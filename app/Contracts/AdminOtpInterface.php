<?php
/**
 * Created by PhpStorm.
 * User: tazes
 * Date: 5/26/2023
 * Time: 9:36 AM
 */

namespace App\Contracts;

use App\Models\User;


interface AdminOtpInterface
{
    public function nullOtp(User $user);
    public function generateOtp(User $user);
    public function verifyOtp(User $user, $otp);
    public function sendAdminOtpNotification(User $user);
}

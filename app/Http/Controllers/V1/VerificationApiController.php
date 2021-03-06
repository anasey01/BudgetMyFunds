<?php

namespace App\Http\Controllers\V1;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;

class VerificationApiController extends Controller
{
 
    /**
    * Show the email verification notice.
    *
    */
    public function show()
    {
        //
    }


    /**
    * Mark the authenticated user’s email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function verify(Request $request)
    {
        try {
            $userID = $request['id'];
            $user = User::findOrFail($userID);

            if ($user->email_verified_at) {
                return formatResponse(400, 'Email already verified! You may proceed to login', false);
            }

            $date = date('Y-m-d g:i:s');
            $user->email_verified_at = $date;
            $user->save();

            return formatResponse(200, 'Email Verified! You may proceed to login', true);
        } catch (Exception $e) {
            return formatResponse(fetchErrorCode($e), get_class($e) . ": " . $e->getMessage());
        }
    }


    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return formatResponse(400, 'This email has already been verified', false);
        }
        $request->user()->sendApiEmailVerificationNotification();

        return formatResponse(200, 'Verification email has been resent', true);
    }
}

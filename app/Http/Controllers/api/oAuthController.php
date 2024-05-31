<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Fouladgar\OTP\Exceptions\InvalidOTPTokenException;
use Fouladgar\OTP\OTPBroker as OTPService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

abstract class oAuthController extends  Controller
{

    public function __construct(private readonly OTPService $OTPService)
    {
    }
    public function sendOTP(Request $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = $this->OTPService->send($request->get('mobile'));
        } catch (Throwable $ex) {
            // or prepare and return a view.
            return response()->json(['message'=>'An unexpected error occurred.'], 500);
        }

        return response()->json(['message'=>'A token has been sent to:'. $user->phone]);
    }

    public function verifyOTPAndLogin(Request $request): JsonResponse
    {
        try {
            /** @var User $user */
            $user = $this->OTPService->validate($request->get('mobile'), $request->get('token'));

            // and do log in actions...

        } catch (InvalidOTPTokenException $exception){
            return response()->json(['error'=>$exception->getMessage()],$exception->getCode());
        } catch (Throwable $ex) {
            return response()->json(['message'=>'An unexpected error occurred.'], 500);
        }

        return response()->json(['message'=>'Logged in successfully.']);
    }
}

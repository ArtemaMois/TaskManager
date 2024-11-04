<?php

namespace App\Http\Controllers\api\Verification;

use App\Events\api\Verification\ResendCodeEvent;
use App\Facades\User\UserFacade;
use App\Facades\Verification\VerificationFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Verification\ResendVerificationCodeRequest;
use App\Http\Requests\api\Verification\VerifyCodeRequest;
use App\Jobs\api\Email\SendVerificationCodeJob;
use App\Jobs\api\Verification\ResendVerificationCode;
use App\Models\User;
use App\Models\VerificationCode;


class VerificationController extends Controller
{
    public function verifyCode(VerifyCodeRequest $request)
    {
        $code = VerificationFacade::getUserVerificationCode($request->validated());
        $result = VerificationFacade::verifyCode($code, $request->input('code'));
        if(!is_bool($result)){
            return response()->json(['status' => 'failed', 'data' => ['error' => $result]], 400);
        }
        UserFacade::addVerifiedEmailAt($request->input('email'));
        return response()->json(['status' => 'success'], 200);
    }

    public function resendCode(ResendVerificationCodeRequest $request)
    {
        $user = UserFacade::getUserByEmail($request->input('email'));
        event(new ResendCodeEvent($user));
        return response()->noContent();
    }
}

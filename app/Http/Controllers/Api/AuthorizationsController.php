<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorizationsController extends Controller
{
    /**
     * @param Request $request
     * @return void|mixed
     */
    public function store(Request $request)
    {
        $code = $request->code;
        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 错误');
        }

        if (!$user = User::where('weapp_openid', $data['openid'])->first()) {
            $user = User::create([
                'weapp_openid' => $data['openid'],
                'weixin_session_key' => $data['session_key'],
            ]);
        }

        $token = Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token);
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * @param $token
     * @return mixed
     */
    public function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}

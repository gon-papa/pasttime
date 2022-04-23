<?php
declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * sanctumで認証されている場合ユーザー情報を返す
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = auth('sanctum')->user();

        if (!$user) {
            return response()->json(['status' => 404, 'message' => ['error' => 'ユーザーが見つかりません']], 404);
        }

        return response()->json(['status' => 200, 'user' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Login
     * 
     * @param \App\Http\Requests\LoginRequest $request
     * @return json {
     *               'status': statusCode,
     *               'message': {'success or error: messageBody'}
     *              }
     */
    public function Login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (auth()->attempt($credentials)) {
            return response()->json(['status' => 200, 'message' => ['success' => 'ログインしました']], 200);
        } else {
            return response()->json(['status' => 400,'message' => ['error' => '登録されていません']], 400);
        }
    }

    /**
     * logout
     *
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['status' => 200, 'message' => ['success' => 'ログアウトしました']], 200);
    }

    /**
     * 認証チェック
     */
    public function checkAuth()
    {
        $result = auth()->check();
        return response()->json(['status' => 200, 'message' => ['result' => $result], 200]);
    }
}

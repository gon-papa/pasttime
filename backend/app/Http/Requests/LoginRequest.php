<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * FormRequestのるようが許可されているユーザーかを判断
     * trueなら許可、falseなら403を返し許可しないことを明示する
     * @return bool
     */
    public function authorize()
    {
        return $this->path() == 'api/v1/login';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): Array
    {
        return [
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): Array
    {
        return [
            'email.required'    => 'メールアドレスを入力してください',
            'email.string'      => '文字列を入力してください',
            'email.email'       => 'Emailアドレス形式で入力してください',
            'password.string'   => '文字列を入力してください',
            'password.required' => 'パスワードを入力してください',
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = response()->json([
            'status' => 400,
            'errors' => $validator->errors(),
        ], 400);

        throw new HttpResponseException($response);
    }
}

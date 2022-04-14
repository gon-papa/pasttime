<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->path() === 'api/v1/admin/blogs/store';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:30',
            'body' => 'required|string|',
            'status' => 'required|integer|between:0,2',
            'thummbnail' => 'required|url',
        ];
    }

    /**
     *  バリデーションメッセージ定義
     * @return array
     */
    public function messages(): Array
    {
        return [
            'required' => ':attributeが空ではなりません',
            'string'   => ':attributeは文字列を入力してください',
            'integer'  => ':attributeは数値を入力してください',
            'between'  => ':attributeは:minから:maxの間の数値としてください',
            'url'      => ':attributeのURLが不正です。',
        ];
    }

    /**
     *  バリデーション項目名定義
     * @return array
     */
    public function attributes()
    {
        return [
            'title'      => 'タイトル',
            'body'       => '本文',
            'status'     => 'ステータス',
            'thummbnail' => 'サムネイル'
        ];
    }

    protected function failedValidation(Validator $validator): HttpResponseException
    {
        $response = response()->json([
            'status' => 400,
            'message' => $validator->errors(),
        ], 400);

        throw new HttpResponseException($response);
    }
}

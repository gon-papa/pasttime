<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploaderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->user()? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image',
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
            'image'   => ':attributeは画像ファイルではありません',
            'uploaded' => ':attributeのアップロードに失敗しました'
        ];
    }

    /**
     *  バリデーション項目名定義
     * @return array
     */
    public function attributes()
    {
        return [
            'image' => '画像ファイル',
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

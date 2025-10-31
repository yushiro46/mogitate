<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // HTTPメソッドを判定
        $isCreate = $this->isMethod('post');
        $isUpdate = $this->isMethod('patch') || $this->isMethod('put');

        // 共通ルール
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|integer|between:0,10000',
            'description' => 'required|max:120',
            'seasons' => 'required|array', // ✅ name="seasons[]" に対応
        ];

        // 新規登録時は画像が必須
        if ($isCreate) {
            $rules['image'] = 'required|image|mimes:png,jpeg';
        }

        // 更新時は画像は任意
        if ($isUpdate) {
            $rules['image'] = 'nullable|image|mimes:png,jpeg';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0~10000円以内で入力してください',

            'image.required' => '商品画像を登録してください',
            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '「.png」 または 「.jpeg」 形式でアップロードしてください',

            'seasons.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}

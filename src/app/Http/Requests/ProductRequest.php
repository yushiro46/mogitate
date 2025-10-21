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
        $isCreate = $this->isMethod('post');
        $isUpdate = $this->Method('patch') || $this->isMethod('put');

        return [
            'name' => ['required'],
            'price' => ['required', 'integer', 'min:0', 'max:10000'],
            'image' => $isCreate
                ? ['required', 'mimes:jpeg,png']
                : ['nullable', 'mimes:jpeg,png'],
            'description' => ['required', 'max:120'],
            'seasons' => $isCreate
                ? ['required', 'array']
                : ['sometimes', 'array'],
            'seasons.*' => ['integer'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.min' => '価格は０円以上で入力してください',
            'price.max' => '価格は１００００円以内で入力してください',
            'image.required' => '商品画像を登録しください',
            'image.mimes' => '画像は .jpeg または .png 形式でアップロードしてください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'seasons.array' => '季節の選択が正しくありません',

        ];
    }
}

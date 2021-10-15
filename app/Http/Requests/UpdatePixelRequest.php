<?php

namespace App\Http\Requests;

use App\Pixel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdatePixelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // If the request is to edit a pixel as a specific user
        // And the user is not an admin
        if (request()->has('user_id') && Auth::user()->role == 0) {
            return false;
        }

        // Check if the pixel to be edited exists under that user
        if (request()->has('user_id')) {
            Pixel::where([['id', '=', request()->route('id')], ['user_id', '=', request()->input('user_id')]])->firstOrFail();
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'min:1', 'max:32', 'unique:pixels,name,'.request()->route('id').',id,user_id,'.(request()->input('user_id') ?? Auth::user()->id)],
            'type' => ['sometimes', 'in:' . implode(',', array_keys(config('pixels')))],
            'pixel_id' => ['sometimes', 'alpha_dash', 'max:255']
        ];
    }
}

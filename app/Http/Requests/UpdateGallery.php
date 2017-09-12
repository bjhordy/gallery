<?php

namespace App\Http\Requests;

use App\Gallery;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGallery extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $gallery = Gallery::find($this->route('id'));
        return auth()->user()->id == $gallery->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'description' => 'min:5'
        ];
    }
}

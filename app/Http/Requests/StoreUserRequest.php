<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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

    public function prepareForValidation()
    {
        if (Route::currentRouteAction() === "App\Http\Controllers\AdminUserController@store") {
            $this->merge([
                'slug' => Str::slug(explode(' ', $this->name)[0] . now()->isoFormat('Hmms'))
            ]);
        } else {
            $this->merge([
                'slug' => $this->user->slug
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','min:2','max:60'],
            'email' => ['required','email','max:60', Rule::unique('users', 'email')->ignore($this->user)],
            'avatar' => ['nullable','image','mimes:jpeg,jpg,png','max:2048'],
            'role_id' => ['required', Rule::exists('roles','id')],
            'classroom_id' => ['nullable', Rule::exists('classrooms','id')],
            'slug' => ['required', Rule::unique('users', 'slug')->ignore($this->user)]
        ];
    }
}

<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug(explode(' ', $this->name)[0] . '-' . Carbon::createFromFormat('d/m/Y', $this->dob)->format('Y-m-d')),
            'dob' => Carbon::createFromFormat('d/m/Y', $this->dob)->format('Y-m-d'),
            'active' => $this->active ?? 0,
            'visitor' => $this->visitor ?? 0,
        ]);
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
            'dob' => ['required','date_format:Y-m-d','before_or_equal:date'],
            'classroom_id' => ['required', Rule::exists('classrooms','id')],
            'zipcode' => ['nullable','regex:/^(\d){5}-(\d){3}$/'],
            'address' => ['nullable','min:5', 'max:60'],
            'neighborhood' => ['nullable','min:2','max:30'],
            'city' => ['nullable','min:3','max:30'],
            'cel' => ['nullable','regex:/^\((\d){2}\) 9(\d){4}-(\d){4}$/'],
            'tel' => ['nullable','regex:/^\((\d){2}\) (\d){4}-(\d){4}$/'],
            'email' => ['nullable','email','max:50'],
            'avatar' => ['nullable','image','mimes:jpeg,jpg,png','max:2048'],
            'slug' => ['required'],
            'active' => ['required'],
            'visitor' => ['required']
        ];
    }
}

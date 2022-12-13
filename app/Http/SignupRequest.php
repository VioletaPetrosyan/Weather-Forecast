<?php


namespace App\Http;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignupRequest extends FormRequest
{
    public $validator = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $this->validator = $validator;
        throw new HttpResponseException(response()->json([
            'errors' => array_map(function ($error) {
                return $error[0] ?? $error;
            }, $errors->getMessages())
        ], 422));
    }
}

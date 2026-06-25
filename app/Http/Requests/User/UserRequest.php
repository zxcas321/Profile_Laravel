<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'  => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8']
        ];
        
        if ($this->getMethod() === 'PUT' || $this->getMethod() === 'PATCH') {
            $rules['email'] = ['required', 'string', 'email', 'unique:users,email,' . $this->route('user')];
            $rules['password'] = ['nullable', 'string', 'min:8'];
        }

        return $rules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'  => false,
                'message' => 'Invalid input. Please check your data.',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
}
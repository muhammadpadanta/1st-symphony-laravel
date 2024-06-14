<?php
// In UserRequest.php

// The namespace of the class. This should match the directory structure of the class file.
namespace App\Http\Requests;

// Importing the FormRequest class from the Laravel framework.
use Illuminate\Foundation\Http\FormRequest;

// The UserRequest class extends the FormRequest class. This allows it to define validation rules and authorization logic for form requests.
class UserRequest extends FormRequest
{
    // The authorize method determines if the current user is authorized to make this request. In this case, it always returns true, meaning any user can make this request.
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'username.regex' => 'The username should not contain any spaces.',
            // other custom messages...
        ];
    }

    // The rules method returns an array of validation rules that this request should adhere to. Each rule is defined as a key-value pair, where the key is the name of the field and the value is the validation rule.
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'name' => 'required',
                    'username' => 'required|unique:users|regex:/^[^\s]*$/',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:8',
                    'gender' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'sometimes|required',
                    'username' => 'sometimes|required|regex:/^[^\s]*$/',
                    'email' => 'sometimes|required|email',
                    'password' => 'sometimes|required|min:8',
                ];
            }
            default:break;
        }
    }
}

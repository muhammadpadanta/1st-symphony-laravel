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

    // The rules method returns an array of validation rules that this request should adhere to. Each rule is defined as a key-value pair, where the key is the name of the field and the value is the validation rule.
    public function rules()
    {
        return [
            // The 'name' field is required.
            'name' => 'required',

            // The 'username' field is required and must be unique in the 'users' table.
            'username' => 'required|unique:users',

            // The 'email' field is required, must be a valid email address, and must be unique in the 'users' table.
            'email' => 'required|email|unique:users',

            /*
            The 'password' field is required, it cant be unique because it will reveal if the password is already used by another user.
            Additional Info:
            - Contain at least one lowercase letter due to regex:/[a-z]/
            - Contain at least one uppercase letter due to regex:/[A-Z]/
            - Contain at least one number due to regex:/[0-9]/  
            - Contain at least one special character due to regex:/[@$!%*#?&]
            */
            'password' => 'required|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            
        ];
    }
}
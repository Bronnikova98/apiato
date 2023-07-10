<?php

namespace App\Containers\UserSection\Authentication\UI\API\Requests;

use App\Containers\UserSection\User\Models\User;
use App\Ship\Parents\Requests\Request as ParentRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends ParentRequest
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => '',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                User::getPasswordValidationRules(),
            ],
            'f_name' => 'required|min:2|max:50',
            'l_name' => 'required|min:2|max:50',
            'm_name' => 'min:2|max:50',
            'phone' => 'required|unique:users,phone',
//            'verification_url' => [
//                'url',
//                Rule::requiredIf(function () {
//                    return config('userSection-authentication.require_email_verification');
//                }),
//                Rule::in(config('userSection-authentication.allowed-verify-email-urls')),
//            ],
        ];
    }


}

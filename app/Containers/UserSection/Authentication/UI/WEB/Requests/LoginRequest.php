<?php

namespace App\Containers\UserSection\Authentication\UI\WEB\Requests;

use App\Containers\UserSection\Authentication\Classes\LoginCustomAttribute;
use App\Ship\Data\Rules\LoginRule;
use App\Ship\Parents\Requests\Request as ParentRequest;

class LoginRequest extends ParentRequest
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => null,
        'roles' => null,
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

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'password' => ['required','min:3','max:30'],
        ];

        return LoginCustomAttribute::mergeValidationRules($rules);
    }

    public function messages()
    {
        return [
            'email.email' => 'Поле должно содержать адрес электронной почты',
            'email.required' => 'Обязательно укажите почту',
            'password.required' => 'Обязательно укажите пароль'
        ];
            }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}

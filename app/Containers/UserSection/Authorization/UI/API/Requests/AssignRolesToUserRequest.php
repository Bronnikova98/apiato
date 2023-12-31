<?php

namespace App\Containers\UserSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

class AssignRolesToUserRequest extends ParentRequest
{
    /*
    * Define which Roles and/or Permissions has access to this request.
    */
    protected array $access = [
        'permissions' => 'manage-admins-access',
        'roles' => '',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'user_id',
        'roles_ids.*',
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
            'roles_ids' => 'array|required',
            'user_id' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }
}

<?php

namespace App\Containers\UserSection\User\Models;

use App\Containers\UserSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\UserSection\Authorization\Traits\AuthorizationTrait;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;


class User extends ParentUserModel
{
    use AuthorizationTrait;
    use AuthenticationTrait;
    use Notifiable;


    protected $fillable = [
        'f_name',
        'l_name',
        'm_name',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilterSearch(Builder $query, string $searchString): Builder
    {
        return $query->where(static function (Builder $query) use ($searchString): Builder {
            $searchArray = explode(' ', $searchString);
            foreach ($searchArray as $searchData) {
                if (null !== $searchData) {
                    $query->where(static function (Builder $query) use ($searchData): Builder {

                        return $query
                            ->orWhere('f_name', 'like', '%' . $searchData . '%')
                            ->orWhere('l_name', 'like', '%' . $searchData . '%')
                            ->orWhere('m_name', 'like', '%' . $searchData . '%');
                    });
                }
            }

            return $query;
        });
    }


}





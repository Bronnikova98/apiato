<?php

namespace App\Containers\UserSection\User\Models;

use App\Containers\UserSection\Authentication\Traits\AuthenticationTrait;
use App\Containers\UserSection\Authorization\Traits\AuthorizationTrait;
use App\Ship\Parents\Models\UserModel as ParentUserModel;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;


/**
 * App\Containers\UserSection\User\Models\User
 *
 * @property int $id
 * @property string $f_name
 * @property string $l_name
 * @property string|null $m_name
 * @property string|null $phone
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Containers\UserSection\Authorization\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Containers\UserSection\Authorization\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \App\Containers\UserSection\User\Data\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User filterSearch(string $searchString)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel permission($permissions)
 * @method static Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserModel role($roles, $guard = null)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLName($value)
 * @method static Builder|User whereMName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends ParentUserModel implements FilamentUser, HasName
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

    public function getFName(): string
    {
        return $this->f_name;
    }

    public function setFName(string $f_name): void
    {
        $this->f_name = $f_name;
    }

    public function getLName(): string
    {
        return $this->l_name;
    }

    public function setLName(string $l_name): void
    {
        $this->l_name = $l_name;
    }

    public function getMName(): ?string
    {
        return $this->m_name;
    }

    public function setMName(?string $m_name): void
    {
        $this->m_name = $m_name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

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

    public function canAccessFilament(): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->getLName();
    }
}





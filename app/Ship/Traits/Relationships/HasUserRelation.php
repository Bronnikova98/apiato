<?php


namespace App\Ship\Traits\Relationships;

use App\Containers\UserSection\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Masterweber\Petrovich\Petrovich;
use Masterweber\Petrovich\Petrovich\Ruleset;

trait HasUserRelation
{

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $userId): void
    {
        $this->user_id = $userId;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return string|null
     */
    public function getUserFirstName(): ?string
    {
        return $this->getUser()?->getFirstName();
    }

    /**
     * @return string|null
     */
    public function getUserLastName(): ?string
    {
        return $this->getUser()?->getLastName();
    }

    /**
     * @return string|null
     */
    public function getUserMiddleName(): ?string
    {
        return $this->getUser()?->getMiddleName();
    }

    /**
     * @return string|null
     */
    public function getUserFullName(): ?string
    {
        return $this->getUser()?->getFullName();
    }


    public function scopeFilterUserSearch(Builder $query, string $value)
    {

    }



}

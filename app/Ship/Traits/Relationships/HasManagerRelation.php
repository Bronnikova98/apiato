<?php


namespace App\Ship\Traits\Relationships;


use App\Containers\UserSection\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasManagerRelation
{

    /**
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * @return User|null
     */
    public function getManager(): ?User
    {
        return $this->manager;
    }


}

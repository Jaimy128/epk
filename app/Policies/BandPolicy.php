<?php

namespace App\Policies;

use App\Models\Band;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BandPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Band  $band
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Band $band)
    {
        if ($band->users()->where('id', $user->id)->get()) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Band  $band
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Band $band)
    {
        if ($band->owner()->where('id', $user->id)->get()->count() > 0) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Band  $band
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Band $band)
    {
        if ($band->owner()->where('id', $user->id)->get()->count() > 0) {
            return true;
        }
    }

    public function viewModerators(User $user, Band $band)
    {
        if ($band->owner()->where('id', $user->id)->get()->count() > 0) {
            return true;
        }
    }

    public function toggleModerators(User $user, Band $band)
    {
        if ($band->owner()->where('id', $user->id)->get()->count() > 0) {
            return true;
        }
    }
}

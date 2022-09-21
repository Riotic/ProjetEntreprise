<?php

namespace App\Policies;

use App\Models\Synthstuc;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SynthstucPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, Synthstuc $synthstuc)
    {
        return $user->role == 'admin' || $user->role == 'formatrice'
                        ? Response::allow()
                        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstuc  $synthstuc
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Synthstuc $synthstuc)
    {
        return $user->id == $synthstuc->user_id || $user->role == 'admin' || $user->id == $synthstuc->client_id
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == 'admin' || $user->role == 'formatrice'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstuc  $synthstuc
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Synthstuc $synthstuc)
    {
        return $user->id == $synthstuc->user_id || $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstuc  $synthstuc
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Synthstuc $synthstuc)
    {
        return $user->id == $synthstuc->user_id || $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstuc  $synthstuc
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Synthstuc $synthstuc)
    {
        return $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstuc  $synthstuc
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Synthstuc $synthstuc)
    {
        return $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }
}

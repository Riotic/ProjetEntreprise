<?php

namespace App\Policies;

use App\Models\Synthstut;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SynthstutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
        return $user->role == 'admin' || $user->role == 'formatrice'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstut  $synthstut
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Synthstut $synthstut)
    {
        //
        return $user->id == $synthstut->user_id || $user->role == 'admin' || $user->id == $synthstut->client_id
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
        //
        return $user->role == 'admin' || $user->role == 'formatrice'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstut  $synthstut
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Synthstut $synthstut)
    {
        return $user->id == $synthstut->user_id || $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstut  $synthstut
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Synthstut $synthstut)
    {
        return $user->id == $synthstut->user_id || $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstut  $synthstut
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Synthstut $synthstut)
    {
        return $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Synthstut  $synthstut
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Synthstut $synthstut)
    {
        return $user->role == 'admin'
        ? Response::allow()
        : Response::deny('Unauthorized');
    }
}

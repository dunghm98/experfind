<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TutorPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, \App\Tutor $tutor)
    {
        return $user->isTutor() && $user->tutor->id === $tutor->id;
    }

    public function update(User $user, \App\Tutor $tutor)
    {
        return $user->isTutor() && $user->tutor->id === $tutor->id;
    }
}

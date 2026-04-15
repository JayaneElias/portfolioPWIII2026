<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Chirp;
use App\Models\User;

class ChirpPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }
        public function view(User $user, Chirp $chirp): bool
        {
            return false;
        }
            public function create(User $user): bool
            {
                return false;
            }
                public function update(User $user, Chirp $chirp): bool
                {
                    return $user->id === $chirp->user_id;
                }
            public function delete(User $user, Chirp $chirp): bool
            {
                return $chirp->user()->is($user);
            }
        public function restore(User $user, Chirp $chirp): bool
        {
            return false;
        }
    public function forceDelete(User $user, Chirp $chirp): bool
    {
        return false;
    }

    
}

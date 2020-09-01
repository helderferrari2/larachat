<?php

namespace App\Traits;

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;

trait UserTrait
{

    /**
     *  Get User Auth
     *
     *
     * @return object
     */
    public function getUserAuth()
    {
        $user = Auth::user();
        if (!$user) {
            throw new CustomException("Unauthenticated", 401);
        }
        return $user;
    }

    public function checkUserPermissions(int $id)
    {
        $user = $this->getUserAuth();
        if ($user->id !== $id) {
            throw new CustomException("Forbidden", 403);
        }
    }
}

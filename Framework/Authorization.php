<?php

namespace JWord\Framework;

use JWord\Framework\Session;

class Authorization
{
    /**
     * Method isOwner checks if the user is the owner of the resource
     *
     * @param int $resource_id
     *
     * @return bool
     */
    public static function isOwner(int $resource_id): bool
    {
        $session_user = Session::get('user');
        if (isset($session_user['id']) && $session_user['id'] !== null) {
            $session_user_id = $session_user['id'];
            return $session_user_id === $resource_id;
        }
        return false;
    }
}

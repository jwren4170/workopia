<?php

namespace JWord\Framework;

use JWord\Framework\Session;

class Authorization
{
    /**
     * Handle user request
     *
     * @param int $resource_id
     * 
     * @return bool
     * 
     */
    public static function is_owner(int $resource_id): bool
    {
        $session_user =   Session::get('user');
        if ($session_user['id'] !== null && isset($session_user['id'])) {
            $session_user_id = $session_user['id'];
            return $session_user_id === $resource_id;
        }
        return false;
    }
}

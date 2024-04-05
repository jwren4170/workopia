<?php

namespace JWord\Framework\Middleware;

use JWord\Framework\Session;

class Authorize
{

    public function isAuthenticated(): bool
    {
        return Session::has('user');
    }

    /**
     * Handle user request
     *
     * @param string $role
     * 
     * @return bool
     * 
     */
    public function handle(string $role): bool
    {
        if ($role === 'guest' && $this->isAuthenticated())
            return redirect('/workopia');
        elseif ($role === 'auth' && !$this->isAuthenticated())
            return redirect('/workopia/auth/login');

        return true;
    }
}

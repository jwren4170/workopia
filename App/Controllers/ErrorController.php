<?php

namespace JWord\App\Controllers;

class ErrorController
{
    /**
     * 404 not found error page
     *
     * @param mixed string
     * 
     * @return void
     * 
     */
    public static function not_found(string $message = 'Resource not found'): void
    {
        http_response_code(404);
        load_view('error', [
            'status' => 404,
            'message' => $message
        ]);
    }

    /**
     * 403 unauthorized error page
     *
     * @param mixed string
     * 
     * @return void
     * 
     */
    public static function unauthorized(string $message = 'You are not authorize to view this page'): void
    {
        http_response_code(403);
        load_view('error', [
            'status' => 403,
            'message' => $message
        ]);
    }
}

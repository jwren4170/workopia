<?php

namespace App\Controllers;


class ErrorController
{
    /*
     * 404 not found error
     *
     * @param string $message
     * @return void
     */
    public static function notFound($message = 'Resource Not Found')
    {
        http_response_code('404');
        load_view('error', [
            'status' => '404',
            'message' => $message,
        ]);
    }

    /*
     * 403 unauthorized error
     *
     * @param string $message
     * @return void
     */
    public static function unauthorized($message = 'You are unauthorized to access this resource')
    {
        http_response_code('403');
        load_view('error', [
            'status' => '403',
            'message' => $message,
        ]);
    }
}

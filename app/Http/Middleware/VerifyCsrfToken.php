<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/survey/delete/*',

        '/login',
        '/loginFromMainPage',
        '/registration',
        '/surveys/create',
        '/surveys/vote',

        '/admin/user/disable/*',
        '/admin/user/enable/*',
        '/admin/user/delete/*'
    ];
}

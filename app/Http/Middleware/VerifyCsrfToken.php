<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [

        // '/create-customer',
        // '/list-customer',
        // '/delete-customer',
        // '/update-customer',
        // '/customer-by-id',
        // '/profile/changePassword/*'
    ];
}

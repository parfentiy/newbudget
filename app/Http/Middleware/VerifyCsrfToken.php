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
        //
<<<<<<< HEAD
            '/webhook',

=======
        '/bdg/main',
        '/add/newexpense',
        '/add/newincome',
        '/add/newexpensetype',
        '/add/newincometype',
        '/add/reportslist',
        'telegramsecret',
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    ];
}

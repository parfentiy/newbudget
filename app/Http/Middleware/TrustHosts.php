<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
<<<<<<< HEAD
    public function hosts(): array
=======
    public function hosts()
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}

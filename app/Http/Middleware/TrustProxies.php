<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustProxies extends Middleware
{
    /**
     * Trust all proxies (CDN/LB). Replace '*' with IPs/CIDRs for stricter setups.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*';

    /**
     * Set at runtime because some Symfony versions lack certain constants.
     *
     * @var int|null
     */
    protected $headers = null;

    public function __construct()
    {
        // Build the bitmask from whatever constants this Symfony version provides.
        $mask  = 0;

        if (defined(SymfonyRequest::class.'::HEADER_X_FORWARDED_FOR')) {
            $mask |= SymfonyRequest::HEADER_X_FORWARDED_FOR;
        }
        if (defined(SymfonyRequest::class.'::HEADER_X_FORWARDED_HOST')) {
            $mask |= SymfonyRequest::HEADER_X_FORWARDED_HOST;
        }
        if (defined(SymfonyRequest::class.'::HEADER_X_FORWARDED_PORT')) {
            $mask |= SymfonyRequest::HEADER_X_FORWARDED_PORT;
        }
        if (defined(SymfonyRequest::class.'::HEADER_X_FORWARDED_PROTO')) {
            $mask |= SymfonyRequest::HEADER_X_FORWARDED_PROTO;
        }
        // Optional extras if your version supports them:
        if (defined(SymfonyRequest::class.'::HEADER_X_FORWARDED_PREFIX')) {
            $mask |= SymfonyRequest::HEADER_X_FORWARDED_PREFIX;
        }
        if (defined(SymfonyRequest::class.'::HEADER_FORWARDED')) {
            $mask |= SymfonyRequest::HEADER_FORWARDED;
        }

        $this->headers = $mask;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MinifyHtml
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response instanceof \Illuminate\Http\Response) {
            $content = $response->getContent();
            $content = preg_replace('/\s+/', ' ', $content); // Remove whitespace
            $content = preg_replace('/<!--.*?-->/', '', $content); // Remove comments
            $response->setContent($content);
        }

        return $response;
    }
}

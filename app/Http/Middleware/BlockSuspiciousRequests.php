<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlockSuspiciousRequests
{
    public function handle(Request $request, Closure $next)
    {
        $suspiciousPaths = [
            'in.php', 'alfanew.php', 'ws.php7', 'wp-load.php', 'wp-activate.php',
            'ini.php', 'upfile.php', 'xmrlpc.php', 'wp-conflg.php', 'plugins.php',
            'ws.php', 'wso112233.php', 'moon.php', 'wp-cron.php', 'wzy.php',
            'ebs.php7', 'simple.php', 'makeasmtp.php'
        ];

        if (in_array($request->path(), $suspiciousPaths) || preg_match('/\.(php|php7)$/i', $request->path())) {
            Log::warning('Blocked suspicious request', ['path' => $request->path(), 'ip' => $request->ip()]);
            return response('Not Found', 404);
        }

        return $next($request);
    }
}
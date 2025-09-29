<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];



    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // If the request is AJAX or expects JSON, return a JSON response
        if ($request->expectsJson() || $request->isXmlHttpRequest()) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to perform this action.'
            ], 401);
        }

        // Redirect non-AJAX requests to the login page
        return redirect()->guest(route('user.login'));
    }


    public function render($request, Throwable $exception)
    {
        // Handle TokenMismatchException (CSRF token mismatch or session timeout)
        if ($exception instanceof TokenMismatchException) {
            Log::error('BindingResolutionException', [
                'message' => $exception->getMessage(),
                'path' => $request->path(),
                'user_id' => auth()->check() ? auth()->user()->id : null,
            ]);
            return redirect()->route('user.login');
        }

        // Handle 404 HTTP exceptions
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404); // Ensure this path matches your view file
            }
        }

        // For all other exceptions, use the default handling
        return parent::render($request, $exception);
    }



    
}

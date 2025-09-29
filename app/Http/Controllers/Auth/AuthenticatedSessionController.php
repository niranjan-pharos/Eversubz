<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Models\User; 
use App\Models\NGO; 
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view. 
     */
    public function userlogin(Request $request)
    {
        // Check if a redirect URL is present in the query
        $redirectUrl = $request->input('redirect') ?? url()->previous();
        
        // Pass the redirect URL to the view so it can be added as a hidden input
        return view('auth.login', ['redirect' => $redirectUrl]);
    }

    /*
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        $request->session()->put('is_admin_approved', $user->is_admin_approved);

        $request->session()->regenerateToken();

        if ($request->has('redirect')) {
            return redirect($request->input('redirect'));
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
     */

    public function store(LoginRequest $request): JsonResponse|RedirectResponse 
    {
        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Invalid email or password.'], 401);
            }
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // Check if user status is 'active'
        if ($user->status !== 'active') {
            Auth::logout();
            
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Your account is inactive. Please contact support.'], 403);
            }
            return redirect()->back()->with('error', 'Your account is inactive. Please contact support.');
        }
    
        // Regenerate the session for security reasons
        $request->session()->regenerate();
    
        // Determine redirect URL
        $redirectUrl = $request->input('redirect') ?? $request->session()->pull('url.intended', route('profile'));
        $redirectUrl .= (strpos($redirectUrl, '?') === false ? '?' : '&') . 't=' . time();
    
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'redirect' => $redirectUrl]);
        }
    
        return redirect()->to($redirectUrl)->with('success', 'Successfully logged in!');
    }
     
     
     
    // for register
    public function register(Request $request)
    {
        Log::debug('Starting registration process', ['email' => $request->email, 'username' => $request->username]);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:255',
            'password' => 'required|confirmed|min:8',
            'account_type' => 'required|integer',
            'signup_check' => 'accepted',
        ]);

        Log::info('Validation passed', ['input' => $request->except('password', 'password_confirmation')]);

        DB::beginTransaction();

        try {
            // Generate unique 6-digit UID
            do {
                $uid = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
            } while (User::where('uid', $uid)->exists());

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => 'active',
                'account_type' => $request->account_type,
                'uid' => $uid,
            ]);

            Log::info('User created successfully', ['user_id' => $user->id, 'email' => $user->email, 'uid' => $uid]);

            Mail::to($user->email)->queue(new WelcomeMail($user));

            Log::debug('Welcome email queued', ['email' => $user->email]);

            // Trigger email verification (sends verification email)
            event(new Registered($user));

            Log::debug('Registered event fired', ['user_id' => $user->id]);

            Auth::login($user);

            Log::info('User logged in', ['user_id' => $user->id, 'auth_check' => Auth::check()]);

            DB::commit();

            $redirectUrl = route('verification.notice');
            Log::debug('Redirecting to verification notice', ['url' => $redirectUrl]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful! Please check your email to verify your account.',
                    'requires_verification' => true,
                    'redirect' => $redirectUrl,
                ]);
            }

            return redirect()->route('verification.notice')->with('success', 'Registration successful! Please check your email to verify your account.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Registration failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }




    public function generateUniqueUsername(string $username): string
    {
        $baseUsername = Str::slug($username);
        $newUsername = $baseUsername;

        $count = 1;
        while (User::where('username', $newUsername)->exists()) {
            $newUsername = $baseUsername . $count;
            $count++;
        }

        return $newUsername;
    }


    public function destroy(Request $request)
    {
        $user = Auth::user();
        \Log::info('Logging out user:', [
            'user_id' => $user?->id,
            'email' => $user?->email,
            'session_id' => session()->getId()
        ]);

        if (!$user) {
            \Log::warning('Logout attempt with no authenticated user.');
            return redirect('/login')->with('status', 'You have been logged out!');
        }

        // Auth::guard('web')->logout(); 
        Auth::logout();
        \Log::info('User logged out:', ['user_id' => $user?->id]);

        $request->session()->invalidate();
        \Log::info('Session invalidated for user:', ['user_id' => $user?->id]);

        $request->session()->regenerateToken();
        \Log::info('Session token regenerated after logout for user:', ['user_id' => $user?->id]);

        \Log::info('Redirecting user to login page after logout', ['user_id' => $user?->id]);

        

        return redirect('/login')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0')
            ->with('status', 'You have been logged out!');
    }


    

    public function authenticate()
    {
        \Log::info('Starting authentication process for email: ' . $this->email);

        // Check for rate limiting and log status
        try {
            $this->ensureIsNotRateLimited();
            \Log::info('Rate limiting check passed for email: ' . $this->email);
        } catch (\Exception $e) {
            \Log::error('User rate-limited', ['email' => $this->email, 'error' => $e->getMessage()]);
            throw $e; // Rethrow the exception to handle it normally
        }

        // Attempt to authenticate the user and log the result
        \Log::info('Attempting to authenticate user with credentials', $this->only('email', 'password'));
        if (! Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {
            \Log::warning('Authentication failed: invalid credentials or inactive user', ['email' => $this->email]);

            // Hit the rate limiter when authentication fails
            RateLimiter::hit($this->throttleKey());
            \Log::info('Rate limit hit for email: ' . $this->email);

            // Throw a validation exception to notify about failure
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Clear rate limiting upon successful login
        \Log::info('User authenticated successfully, clearing rate limit for email: ' . $this->email);
        RateLimiter::clear($this->throttleKey());

        // Log successful login details
        $user = Auth::user();
        \Log::info('Authenticated User:', ['id' => $user->id, 'email' => $user->email]);

        // Log if session regeneration occurs (useful for session fixation attack prevention)
        try {
            $this->session()->regenerate();
            \Log::info('Session regenerated for user: ' . $user->email);
        } catch (\Exception $e) {
            \Log::error('Session regeneration failed for user: ' . $user->email, ['error' => $e->getMessage()]);
        }
    }



}


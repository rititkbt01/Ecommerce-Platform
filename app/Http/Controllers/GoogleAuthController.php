<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            // Get user info from Google
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user exists with this Google ID
            $user = User::where('google_id', $googleUser->id)->first();
            
            if ($user) {
                // User exists, just log them in
                Auth::login($user);
                
                // Redirect based on role
                if ($user->role === 'admin') {
                    return redirect('/admin')->with('success', 'Welcome back, ' . $user->name . '!');
                }
                return redirect('/')->with('success', 'Welcome back, ' . $user->name . '!');
            }
            
            // Check if user exists with this email (link accounts)
            $existingUser = User::where('email', $googleUser->email)->first();
            
            if ($existingUser) {
                // Link Google account to existing user
                $existingUser->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                ]);
                
                Auth::login($existingUser);
                
                if ($existingUser->role === 'admin') {
                    return redirect('/admin')->with('success', 'Google account linked successfully!');
                }
                return redirect('/')->with('success', 'Google account linked successfully!');
            }
            
            // Create new user
            $newUser = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => Hash::make(Str::random(16)), // Random password
                'role' => 'customer',
            ]);
            
            Auth::login($newUser);
            
            return redirect('/')->with('success', 'Account created successfully! Welcome to ShopEase!');
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication failed. Please try again.');
        }
    }
}
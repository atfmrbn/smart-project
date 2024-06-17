<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            // Google user object from Google
            $userFromGoogle = Socialite::driver('google')->user();

            // Log user information
            Log::info('User from Google:', ['user' => $userFromGoogle]);

            // Retrieve user from the database based on email
            $userFromDatabase = User::where('email', $userFromGoogle->getEmail())->first();

            // Log database user information
            Log::info('User from Database:', ['user' => $userFromDatabase]);

            // If no user with that email exists, deny access
            if (!$userFromDatabase) {
                Log::warning('User not found in the database');
                return redirect('/')->with('errorMessage', 'Email not registered.');
            }

            // Update google_id if needed
            $userFromDatabase->google_id = $userFromGoogle->getId();
            $userFromDatabase->save();

            // Check the user's role
            $role = $userFromDatabase->role; // Assuming `role` is a column in your users table

            // Log user role
            Log::info('User role:', ['role' => $role]);

            // Redirect based on role
            switch ($role) {
                case 'Super Admin':
                    $redirectTo = 'superAdmin.dashboard';
                    break;
                case 'Admin':
                    $redirectTo = 'admin.dashboard';
                    break;
                case 'Teacher':
                    $redirectTo = 'teacher.dashboard';
                    break;
                case 'Librarian':
                    $redirectTo = 'librarian.dashboard';
                    break;
                case 'Student':
                    $redirectTo = 'student.dashboard';
                    break;
                case 'Parent':
                    $redirectTo = 'parent.dashboard';
                    break;
                default:
                    Log::error('Invalid role', ['role' => $role]);
                    return redirect('/')->with('errorMessage', 'Invalid role.');
            }

            // Login the user
            auth('web')->login($userFromDatabase);
            session()->regenerate();

            // Log successful login
            Log::info('User logged in successfully', ['user' => $userFromDatabase]);

            // Redirect to the appropriate dashboard
            return redirect()->route($redirectTo);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Exception during callback', ['exception' => $e]);
            return redirect('/')->with('errorMessage', 'An error occurred during login.');
        }
    }

    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
//use Illuminate\Http\Request;

class CheckUserRole {

    public function handle($request, Closure $next, $roles) {

        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the user's role
            $userRole = Auth::user()->userType;

            // Check if the user's role matches any of the specified roles
            if ($userRole === $roles) {
                    return $next($request);
                }
        }

        // If the user is not authorized, you can redirect to a different route based on their role
        $userRole = Auth::user()->userType;

        if ($userRole == 'Administrator') {
            return redirect()->route('admin.home');
        } elseif ($userRole == 'Student') {
            return redirect()->route('student.home');
        } elseif ($userRole == 'Tutor') {
            return redirect()->route('tutor.home');
        }  else {
            // Handle other roles or unauthorized users here
            return redirect()->route('index'); // Or any other fallback route
        }
    }
}
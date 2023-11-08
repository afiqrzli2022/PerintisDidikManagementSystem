<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        $student = Auth::user()->student;

        // Check if the student has a subscription
        if ($student->latestSubs) {
            return $next($request);
        }

        // If the student doesn't have a subscription, redirect to the subscription page
        return redirect()->route('student.subscription');
    }
}

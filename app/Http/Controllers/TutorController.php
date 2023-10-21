<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;//debug

class TutorController extends Controller
{

    public function showLoginForm()
    {
        return view('tutor-sign-in');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'userID' => 'required',
            'password' => 'required',
        ]);

        $credentials['userType'] = 'Tutor';

        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            $tutor = $user->Tutor;

            if ($tutor) {
                session(['user' => $user]);
                session(['tutor' => $tutor]);
                return redirect()->route('tutor.home');
            }
        }

        return redirect()->back()->withErrors(['userID' => 'Invalid credentials']);
    }

    public function showRegistrationForm()
    {
        return view('tutor-sign-up');
    }

    public function register(Request $request)
    {

        Log::error("Test 1");
        // Validate the incoming request data
        $validatedData = $request->validate([
            'userID' => 'required|string|max:12|unique:users,userID',
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:15',
            'userEmail' => 'required|email',
            'password' => 'required|string|min:6',
            
            'educationLevel' => 'required|string|max:45',
            'workingExperience' => 'required|string',
        ]);

        Log::debug("Test 2");
        
        DB::beginTransaction();
        
        Log::debug("Test 3");
        // Create a new user
        $user = User::create([
            'userID' => $request->userID,
            'userName' => $request->userName,
            'userNumber' => $request->userNumber,
            'userEmail' => $request->userEmail,
            'password' => bcrypt($request->password),
            
            'userCreateDate' => now(),
            'userStatus' => 'Active',
            'userType' => 'Tutor',
        ]);

        Log::debug("Test 4");
        
        // Create a new tutor record
        $tutor = Tutor::create([
            'userID' => $user->userID,
            'educationLevel' => $request->educationLevel,
            'workingExperience' => $request->workingExperience,
        ]);
        
        Log::debug("Test 5");
        
        DB::commit();
        
        Log::debug("Test 6");
        
        session(['user'=>$user]);
        session(['tutor'=>$tutor]);
        
        Log::debug("Test 7");
        // Redirect to a success page or any other page as needed
        return redirect()->route('tutor.home')->with('success', 'Registration successful!');
        
        Log::debug("Test 8");
    }

    public function updateProfile(Request $request){

        $rules = [
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:15',
            'userEmail' => 'required|email',
            
            'workingExperience' => 'required|string',
        ];

        if ($request->has('password') && filled($request->password)) {
            $rules['password'] = 'required|string|min:6';
        }

        $errorMsg = [
            'userName.required' => 'The full name is required.',
            'userName.max' => 'The full name must not exceed 100 characters.',
            'userNumber.required' => 'The phone number is required.',
            'userNumber.max' => 'The phone number must not exceed 15 characters.',
            'userEmail.required' => 'The email address is required.',
            'userEmail.email' => 'Invalid email format.',
            'workingExperience.required' => 'Working experience is required.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $errorMsg);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $user = User::find(Auth::user()->userID);
        $tutor = Tutor::find(Auth::user()->userID);
    
        $user->userName = $request->input('userName');
        $user->userNumber = $request->input('userNumber');
        $user->userEmail = $request->input('userEmail');
        
        $tutor->workingExperience = $request->input('workingExperience');
    
        if ($request->has('password') && filled($request->password)) {
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
        $tutor->save();
    
        session()->flash('success', 'Profile updated successfully.');
    
        return redirect()->route('tutor.profile');
    }

}
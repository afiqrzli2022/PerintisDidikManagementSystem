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

        $rules = [
            'userID' => ['required','string','max:14','unique:users,userID', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|regex:/^01\d{8,9}$/|max:11',
            'userEmail' => 'required|email',
            'password' => 'required|string|min:6|confirmed',

            'workingExperience' => 'required|string',
        ];

        $errorMsg = [
            'userID' => [
                'required' => 'IC Number is required.',
                'max' => 'IC Number must not exceed 14 characters.',
                'unique' => 'IC Number has already been used.',
                'regex' => 'Please enter IC Number in the following format: 000000-00-0000',
            ],
            'userName' => [
                'required' => 'The full name is required.',
                'max' => 'The full name must not exceed 100 characters.',
            ],
            'userNumber' => [
                'required' => 'The phone number is required.',
                'max' => 'The phone number must not exceed 11 characters.',
                'regex' => 'Please enter the phone number in the following format: 0102345678',
            ],
            'userEmail' => [
                'required' => 'The email address is required.',
                'email' => 'Invalid email format.',
            ],
            'password' => [
                'required' => 'The password is required.',
                'min' => 'The password must be at least 6 characters.',
                'confirmed' => 'The password confirmation does not match.',
            ],
            'workingExperience' => [
                'required' => 'The working experience is required.',
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);
    
        if ($validator->fails()) {
            $request->flash();
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        
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

        // Create a new tutor record
        $tutor = Tutor::create([
            'userID' => $user->userID,
            'educationLevel' => $request->educationLevel,
            'workingExperience' => $request->workingExperience,
        ]);
        
        DB::commit();
        
        // Redirect to a success page or any other page as needed
        return redirect()->route('tutor.signin')->with('success', 'Registration successful!');
        
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
    
        DB::beginTransaction();

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

        DB::commit();
    
        return redirect()->route('tutor.profile');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{

    public function showLoginForm()
    {
        return view('admin-sign-in');
    }

    public function processLogin(Request $request)
    {
        /*$credentials = $request->validate([
            'userID' => 'required',
            'password' => 'required',
        ]);*/

        $credentials = $request->validate([
            'userID' => 'required', // Ensure 'userID' is a string and required
            'password' => 'required',
        ], [
            'userID.required' => 'The IC number is required.', // Custom error message
        ]);

        $credentials['userType'] = 'Administrator'; // Make sure it's a student login only

        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            $administrator = $user->administrator;

            if ($administrator) {
                session(['user' => $user]);
                return redirect()->route('admin.home');
            }
        }

        return redirect()->back()->withErrors(['userID' => 'Invalid credentials']);
    }

    // -------------------------------------------

    public function showRegistrationForm()
    {
        return view('admin-sign-up');
    }

    public function register(Request $request)
    {

        $rules = [
            'userID' => ['required','string','max:14','unique:users,userID', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:11|regex:/^01\d{8,9}$/',
            'userEmail' => 'required|email|regex:/^[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([-.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:6|confirmed',

            'adminRoles' => 'required|string|max:45',
            'officeNumber' => 'required|string|max:10|regex:/^0\d{8,9}$/',
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
                'regex' => 'Email only allowed single dot, alphabet and digit before @ and must have . after @ (Ex: perintisdidik@gmail.com).',
            ],
            'password' => [
                'required' => 'The password is required.',
                'min' => 'The password must be at least 6 characters.',
                'confirmed' => 'The password and re-enter password does not match.',
            ],
            'officeNumber' => [
                'required' => 'The office phone number is required.',
                'max' => 'The office phone number must not exceed 10 characters.',
                'regex' => 'Please enter the office phone number in the following format: 020011113',
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
            'userType' => 'Administrator',
        ]);

        // Create a new administrator record
        $administrator = Administrator::create([
            'userID' => $user->userID,
            'adminRoles' => $request->adminRoles,
            'officeNumber' => $request->officeNumber,
        ]);

        DB::commit();

        // Redirect to a success page or any other page as needed
        return redirect()->route('admin.signin')->with('success', 'Registration successful!');
    }

    public function updateProfile(Request $request){

        $rules = [
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:11|regex:/^01\d{8,9}$/',
            'userEmail' => 'required|email|regex:/^[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([-.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/',
            
            'officeNumber' => 'required|string|max:10|regex:/^0\d{8,9}$/',
        ];

        $oldPassword = $request->input('oldPassword');

        if ($request->anyFilled(['password', 'oldPassword', 'password_confirmation'])) {
            $rules['password'] = 'required|string|min:6|confirmed';
            $rules['oldPassword'] = ['required',
                function ($attribute, $value, $fail) use ($oldPassword) {
                    $user = Auth::user();
                    if (!Hash::check($value, $user->password)) {
                        $fail('The old password does not match.');
                    }
                },];
        }

        $errorMsg = [
            'userName.required' => 'The full name is required.',
            'userName.max' => 'The full name must not exceed 100 characters.',
            'userNumber.required' => 'The phone number is required.',
            'userNumber.max' => 'The phone number must not exceed 15 characters.',
            'userNumber.regex' => 'Please enter the phone number in the following format: 0102345678.',
            'userEmail.required' => 'The email address is required.',
            'userEmail.email' => 'Invalid email format.',
            'userEmail.regex' => 'Email only allowed single dot, alphabet and digit before @ and must have . after @ (Ex: perintisdidik@gmail.com).',
            'officeNumber.required' => 'The office phone number is required.',
            'officeNumber.max' => 'The office phone number must not exceed 10 characters.',
            'officeNumber.regex' => 'Please enter the office phone number in the following format: 020011113.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The new password and re-enter password does not match.',
            'oldPassword.required' => 'The old password is required.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $errorMsg);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        $user = User::find(Auth::user()->userID);
        $admin = Administrator::find(Auth::user()->userID);

        $user->userName = $request->input('userName');
        $user->userNumber = $request->input('userNumber');
        $user->userEmail = $request->input('userEmail');

        $admin->officeNumber = $request->input('officeNumber');

        if ($request->has('password') && filled($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        $admin->save();

        session()->flash('success', 'Profile updated successfully.');

        DB::commit();

        return redirect()->route('admin.profile');

    }
}
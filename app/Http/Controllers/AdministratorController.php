<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $credentials = $request->validate([
            'userID' => 'required',
            'password' => 'required',
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
            'userNumber' => 'required|string|regex:/^01\d{8,9}$/|max:11',
            'userEmail' => 'required|email',
            'password' => 'required|string|min:6',

            'adminRoles' => 'required|string|max:45',
            'officeNumber' => 'required|string|regex:/^0\d{8,9}$/|max:10',
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
            ],
            'officeNumber' => [
                'required' => 'The office phone number is required.',
                'max' => 'The office phone number must not exceed 10 characters.',
                'regex' => 'Please enter the office phone number in the following format: 0200011113',
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
            'userNumber' => 'required|string|max:15',
            'userEmail' => 'required|email',
            
            'officeNumber' => 'required|string|max:15',
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
            'officeNumber.required' => 'The office phone number is required.',
            'officeNumber.max' => 'The office phone number must not exceed 15 characters.',
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
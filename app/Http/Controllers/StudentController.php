<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function showLoginForm()
    {
        return view('student-sign-in');
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

        $credentials['userType'] = 'Student'; // Make sure it's a student login only

        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            $student = $user->Student;

            if ($student) {
                return redirect()->route('student.home');
            }
        }

        return redirect()->back()->withErrors(['userID' => 'Invalid credentials']);
    }

    // -------------------------------------------

    public function showRegistrationForm()
    {
        return view('student-sign-up');
    }

    public function register(Request $request)
    {

        $rules = [
            'userID' => ['required','string','max:14','unique:users,userID', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:11|regex:/^01\d{8,9}$/',
            'userEmail' => 'required|email|regex:/^[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([-.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:6|confirmed',

            'guardianName' => 'required|string|max:100',
            'guardianNumber' => 'required|string|max:11|regex:/^01\d{8,9}$/',
            'studentAddress' => 'required|string|max:200',
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
                'confirmed' => 'The new password and re-enter password does not match.',
            ],
            'guardianName' => [
                'required' => 'The guardian name is required.',
                'max' => 'The guardian name must not exceed 100 characters.',
            ],
            'guardianNumber' => [
                'required' => 'The phone number is required.',
                'max' => 'The phone number must not exceed 11 characters.',
                'regex' => 'Please enter the phone number in the following format: 0102345678',
            ],
            'studentAddress' => [
                'required' => 'The address is required.',
                'max' => 'The address must not exceed 00 characters.',
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
            'userType' => 'Student',
        ]);

        // Create a new student record
        $student = Student::create([
            'userID' => $user->userID,
            'guardianName' => $request->guardianName,
            'guardianNumber' => $request->guardianNumber,
            'studentAddress' => $request->studentAddress,
        ]);

        DB::commit();

        Auth::login($user);

        // Redirect to a success page or any other page as needed
        return redirect()->route('student.subscription')->with('success', 'Registration successful!');
    }

    public function updateProfile(Request $request){
        
        DB::beginTransaction();

        $rules = [
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:11|regex:/^01\d{8,9}$/',
            'userEmail' => 'required|email|regex:/^[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([-.][a-zA-Z0-9]+)*\.[a-zA-Z]{2,}$/',
            
            'guardianName' => 'required|string|max:100',
            'guardianNumber' => 'required|string|max:11|regex:/^01\d{8,9}$/',
            'studentAddress' => 'required|string|max:200',
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
            'userNumber.regex' => 'Please enter the phone number in the following format: 0102345678.',
            'userNumber.max' => 'The phone number must not exceed 11 characters.',
            'userEmail.required' => 'The email address is required.',
            'userEmail.email' => 'Invalid email format.',
            'userEmail.regex' => 'Email only allowed single dot, alphabet and digit before @ and must have . after @ (Ex: perintisdidik@gmail.com).',
            'guardianName.required' => 'The guardian name is required.',
            'guardianName.max' => 'The guardian name must not exceed 100 characters.',
            'guardianNumber.required' => 'The guardian phone number is required.',
            'guardianNumber.regex' => 'Please enter the phone number in the following format: 0102345678.',
            'guardianNumber.max' => 'The guardian phone number must not exceed 11 characters.',
            'studentAddress.required' => 'The student address is required.',
            'studentAddress.max' => 'The student address must not exceed 200 characters.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The new password and re-enter password does not match.',
            'oldPassword.required' => 'The old password is required.',
        ];
    
        $validator = Validator::make($request->all(), $rules, $errorMsg);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->userID);
        $student = Student::find(Auth::user()->userID);

        $user->userName = $request->input('userName');
        $user->userNumber = $request->input('userNumber');
        $user->userEmail = $request->input('userEmail');

        $student->guardianName = $request->input('guardianName');
        $student->guardianNumber = $request->input('guardianNumber');
        $student->studentAddress = $request->input('studentAddress');

        if ($request->has('password') && filled($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();
        $student->save();

        DB::commit();

        session()->flash('success', 'Profile updated successfully.');

        return redirect()->route('student.profile');

    }
    
}

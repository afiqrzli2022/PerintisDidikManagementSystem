<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $credentials = $request->validate([
            'userID' => 'required',
            'password' => 'required',
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'userID' => 'required|string|max:12|unique:users,userID',
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:15',
            'userEmail' => 'required|email',
            'password' => 'required|string|min:6',

            'guardianName' => 'required|string|max:100',
            'guardianNumber' => 'required|string|max:15',
            'studentAddress' => 'required|string|max:200',
        ]);

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
        return redirect()->route('student.home')->with('success', 'Registration successful!');
    }

    public function updateProfile(Request $request){

        $rules = [
            'userName' => 'required|string|max:100',
            'userNumber' => 'required|string|max:15',
            'userEmail' => 'required|email',
            
            'guardianName' => 'required|string|max:100',
            'guardianNumber' => 'required|string|max:15',
            'studentAddress' => 'required|string|max:200',
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
            'guardianName.required' => 'The guardian name is required.',
            'guardianName.max' => 'The guardian name must not exceed 100 characters.',
            'guardianNumber.required' => 'The guardian phone number is required.',
            'guardianNumber.max' => 'The guardian phone number must not exceed 15 characters.',
            'studentAddress.required' => 'The student address is required.',
            'studentAddress.max' => 'The student address must not exceed 200 characters.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
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

        session()->flash('success', 'Profile updated successfully.');

        return redirect()->route('student.profile');

    }
    
    
}

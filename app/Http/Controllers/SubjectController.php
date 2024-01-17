<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\EducationLevel;
use App\Models\Subscription;
use App\Models\Tutor;
use Illuminate\Database\QueryException;

class SubjectController extends Controller
{
    // Listing
    public function indexListSubject()
    {
        $subjects = Subject::all();
        $educationLevels = EducationLevel::pluck('eduName', 'eduID');
        $tutors = Tutor::all();

        return view('admin.subject', compact('subjects', 'educationLevels', 'tutors'));
    }

    public function create(Request $request)
    {
        $rules = [
            'subjectID' => 'required|string|max:10|unique:subject,subjectID', // Check for unique subjectID
            'subjectName' => 'required|string|max:45',
            'time' => 'required',
            'day' => 'required|string|max:10',
            'duration' => 'required|string',
            'eduID' => 'required|exists:educationlevel,eduID',
            'tutorID' => 'required|exists:tutor,userID',
        ];

        $errorMsg = [
            'subjectID.required' => 'The Subject ID field is required.',
            'subjectID.string' => 'The Subject ID must be a string.',
            'subjectID.max' => 'The Subject ID must not be greater than :10.',
            'subjectID.unique' => 'The Subject ID has already been taken.',
            'subjectName.required' => 'The Subject Name field is required.',
            'subjectName.string' => 'The Subject Name must be a string.',
            'subjectName.max' => 'The Subject Name must not be greater than :45.',
            'time.required' => 'The Time field is required.',
            'day.required' => 'The Day field is required.',
            'day.string' => 'The Day must be a string.',
            'day.max' => 'The Day must not be greater than :10.',
            'duration.required' => 'The Duration field is required.',
            'duration.string' => 'The Duration must be a string.',
            'eduID.required' => 'The Education Level ID field is required.',
            'eduID.exists' => 'The selected Education Level ID is invalid.',
            'tutorID.required' => 'The Tutor ID field is required.',
            'tutorID.exists' => 'The selected Tutor ID is invalid.',
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $startTime =  $request->input('time');
        $duration = $request->input('duration');
        $endTime = \Carbon\Carbon::parse($startTime)
                    ->addHours(intval(explode(':', $duration)[0]))
                    ->addMinutes(intval(explode(':', $duration)[1]))
                    ->format('H:i:s');
        $tutorID = $request->input('tutorID');
        $day = $request->input('day');

        $overlappingSubjects = Subject::where('tutorID', $tutorID)
                                ->where('day', $day)
                                ->where('time', '<', $endTime)
                                ->whereRaw('? < ("time" + "duration")', [$startTime])
                                ->get();

        $formattedStart = \Carbon\Carbon::parse($startTime)
                        ->format('h:i a');
        $formattedEnd = \Carbon\Carbon::parse($endTime)
                        ->format('h:i a');

        if (!$overlappingSubjects->isEmpty()) {
            return redirect()->back()->with('error', "Overlapped Class: Selected tutor already have class on $day at $formattedStart - $formattedEnd");
        } else {
            $subject = Subject::create([
                'subjectID' => $request->input('subjectID'),
                'subjectName' => $request->input('subjectName'),
                'time' => $request->input('time'),
                'day' => $request->input('day'),
                'duration' => $request->input('duration'),
                'eduID' => $request->input('eduID'),
                'tutorID' => $request->input('tutorID'),
            ]);
    
            return redirect()->route('listsubject')->with('success', 'Subject created successfully!');
        }

    }

    public function scheduleStudent(){
        $schedule = Subscription::find(Auth::user()->student->latestSubs)->first();
        return view('student.schedule', compact('schedule'));
    }

    public function scheduleTutor(){
        $schedule = Subscription::find(Auth::user()->student->latestSubs)->first();
        return view('student.schedule', compact('schedule'));
    }

    public function update(Request $request, $subjectID)
    {
        $subj = Subject::find($subjectID);

        if (!$subj) {
            return redirect()->back()->with('error', 'Subject not found.');
        }

        $rules = [
            'subjectID' => 'required|string|max:100|unique:subject,subjectID,' . $subjectID . ',subjectID', // Include unique validation, ignoring the current subject ID
            'subjectName' => 'required|string|max:100',
            'time' => 'required',
            'day' => 'required|string|max:10',
            'duration' => 'required|string|max:20',
            'eduID' => 'required|exists:educationlevel,eduID',
            'tutorID' => 'required|exists:tutor,userID',
        ];

        $errorMsg = [
            'subjectID.required' => 'The Subject ID field is required.',
            'subjectID.string' => 'The Subject ID must be a string.',
            'subjectID.max' => 'The Subject ID must not be greater than :10.',
            'subjectID.unique' => 'The Subject ID has already been taken.',
            'subjectName.required' => 'The Subject Name field is required.',
            'subjectName.string' => 'The Subject Name must be a string.',
            'subjectName.max' => 'The Subject Name must not be greater than :45.',
            'time.required' => 'The Time field is required.',
            'day.required' => 'The Day field is required.',
            'day.string' => 'The Day must be a string.',
            'day.max' => 'The Day must not be greater than :10.',
            'duration.required' => 'The Duration field is required.',
            'duration.string' => 'The Duration must be a string.',
            'eduID.required' => 'The Education Level ID field is required.',
            'eduID.exists' => 'The selected Education Level ID is invalid.',
            'tutorID.required' => 'The Tutor ID field is required.',
            'tutorID.exists' => 'The selected Tutor ID is invalid.',
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $startTime =  $request->input('time');
        $duration = $request->input('duration');
        $endTime = \Carbon\Carbon::parse($startTime)
                    ->addHours(intval(explode(':', $duration)[0]))
                    ->addMinutes(intval(explode(':', $duration)[1]))
                    ->format('H:i:s');
        $tutorID = $request->input('tutorID');
        $day = $request->input('day');

        $overlappingSubjects = Subject::where('tutorID', $tutorID)
                                ->where('day', $day)
                                ->where('time', '<', $endTime)
                                ->whereRaw('? < ("time" + "duration")', [$startTime])
                                ->where('subjectID', '<>', $subjectID)
                                ->get();

        $formattedStart = \Carbon\Carbon::parse($startTime)
                        ->format('h:i a');
        $formattedEnd = \Carbon\Carbon::parse($endTime)
                        ->format('h:i a');

        if (!$overlappingSubjects->isEmpty()) {
            return redirect()->back()->with('error', "Overlapped Class: Selected tutor already have class on $day at $formattedStart - $formattedEnd");
        } else {
            $subj->update($request->all());
    
            return redirect()->route('listsubject')->with('success', 'Subject updated successfully!');
        }
        
    }


    public function destroys($subjectID)
    {
        $subj = Subject::find($subjectID);

        if (!$subj) {
            return redirect()->back()->with('error', 'Subject not found.');
        }

        $subj->delete();

        return redirect()->route('listsubject')->with('success', 'Subject deleted successfully!');
    }

    public function destroy($subjectID)
    {
        $subj = Subject::find($subjectID);
    
        if (!$subj) {
            return redirect()->back()->with('error', 'Subject not found.');
        }
       
        Log::debug("message");

        try {

            $subj->delete();

            return redirect()->route('listsubject')->with('success', 'Subject deleted successfully!');
        
        } catch (QueryException $e) {

            return redirect()->back()->withErrors('error', 'Deletion Failed: The subject is referenced by other records.');

        }
    }
}

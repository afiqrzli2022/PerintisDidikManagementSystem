<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use App\Models\EducationLevel;
use App\Models\Tutor;

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
        $request->validate([
            'subjectID' => 'required|string|max:10|unique:subject,subjectID', // Check for unique subjectID
            'subjectName' => 'required|string|max:45',
            'time' => 'required',
            'day' => 'required|string|max:10',
            'duration' => 'required|string|max:20',
            'eduID' => 'required|exists:educationlevel,eduID',
            'tutorID' => 'required|exists:tutor,userID',
        ]);

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


    public function update(Request $request, $subjectID)
    {
        $subj = Subject::find($subjectID);

        if (!$subj) {
            return redirect()->back()->with('error', 'Subject not found.');
        }

        $validator = Validator::make($request->all(), [
            'subjectID' => 'required|string|max:100|unique:subject,subjectID,' . $subjectID . ',subjectID', // Include unique validation, ignoring the current subject ID
            'subjectName' => 'required|string|max:100',
            'time' => 'required',
            'day' => 'required|string|max:10',
            'duration' => 'required|string|max:20',
            'eduID' => 'required|exists:educationlevel,eduID',
            'tutorID' => 'required|exists:tutor,userID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subj->update($request->all());

        return redirect()->route('listsubject')->with('success', 'Subject updated successfully!');
    }


    public function destroy($subjectID)
    {
        $subj = Subject::find($subjectID);

        if (!$subj) {
            return redirect()->back()->with('error', 'Subject not found.');
        }

        $subj->delete();

        return redirect()->route('listsubject')->with('success', 'Subject deleted successfully!');
    }
}

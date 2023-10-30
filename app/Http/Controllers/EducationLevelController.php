<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EducationLevelController extends Controller
{
    // Listing
    public function indexListEdulevel()
    {
        $educationLevels = EducationLevel::all();

        return view('admin/education-level', compact('educationLevels'));
    }

    // Create function
    public function create(Request $request)
    {

        $rules = [
            'eduID' => 'required|string|max:10|unique:educationlevel,eduID',
            'eduName' => 'required|string|max:45', 
        ];

        $errorMsg = [
            'eduID.required' => 'Education Level ID is required.',
            'eduID.max' => 'The Education Level ID must not exceed 10 characters.',
            'eduID.unique' => 'Education Level ID is already taken.',
            'eduName.max' => 'Education level name must not exceed 45 characters.',
            'eduName.required' => 'Education level name is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        // Create a new edu with the validated data
        $edulevel = new EducationLevel([
            'eduID' => $request->input('eduID'),
            'eduName' => $request->input('eduName'),
        ]);

        // Save the edu to the database
        $edulevel->save();

        // Redirect to the 'listedu' route after successful creation
        return redirect()->route('listedulevel')->with('success', 'Education Level created successfully!');
    }

    //update function
    public function update(Request $request, $eduID){
        
        $educationLevel = EducationLevel::find($eduID);
        
        if (!$educationLevel) {
            return redirect()->route('listedulevel')->with('error', 'Education level not found!');
        }

        $rules = [
            'eduID' => 'required|string|max:10|unique:educationlevel,eduID,'.$eduID.',eduID',
            'eduName' => 'required|string|max:45', 
        ];

        $errorMsg = [
            'eduID.required' => 'Education Level ID is required.',
            'eduID.max' => 'The Education Level ID must not exceed 10 characters.',
            'eduID.unique' => 'Education Level ID is already taken.',
            'eduName.max' => 'Education level name must not exceed 45 characters.',
            'eduName.required' => 'Education level name is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update the education level with the validated data
        $educationLevel->eduID = $request->input('eduID');
        $educationLevel->eduName = $request->input('eduName');
        $educationLevel->save();

        // Redirect to the 'listedulevel' route after successful update
        return redirect()->route('listedulevel')->with('success', 'Education level updated successfully!');
    }

    // Delete function
    public function destroy($eduID) {
        // Find the education level by its ID
        $educationLevel = EducationLevel::find($eduID);

        if (!$educationLevel) {
            return redirect()->route('listedulevel')->with('error', 'Education level not found!');
        }

        // Delete the education level
        $educationLevel->delete();

        // Redirect to the 'listedulevel' route after successful deletion
        return redirect()->route('listedulevel')->with('success', 'Education level deleted successfully!');
    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    // Listing
    public function indexListPackage()
    {
        $packages = Package::all();
        $educationLevels = EducationLevel::pluck('eduName', 'eduID');

        return view('admin/package', compact('packages', 'educationLevels'));
    }

    // Create function
public function create(Request $request)
{
    $rules =[
        'packageID' => 'required|unique:package,packageID|string|max:10',
        'packageName' => 'required|string|max:100',
        'subjectQuantity' => 'required|integer|min:0',
        'packagePrice' => 'required|numeric|min:0',
        'eduID' => 'required|exists:educationlevel,eduID', // Correct the table name to 'educationlevel'
    ];

    $errorMsg = [
        'packageID.required' => 'Package ID is required.',
        'packageID.unique' => 'Package ID is already taken.',
        'packageID.max' => 'The Package ID must not exceed 10 characters.',
        'packageName.required' => 'Package Name is required.',
        'packageName.max' => 'The Package Name must not exceed 100 characters.',
        'subjectQuantity.required' => 'Subject Quantity is required.',
        'subjectQuantity.integer' => 'Subject Quantity must be an integer.',
        'subjectQuantity.min' => 'Subject Quantity must be at least 0.',
        'packagePrice.required' => 'Package Price is required.',
        'packagePrice.numeric' => 'Package Price must be a numeric value.',
        'packagePrice.min' => 'Package Price must be at least start from RM0.',
    ];

    $validator = Validator::make($request->all(), $rules, $errorMsg);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    // Create a new Package with the validated data
    $package = Package::create([
        'packageID' => $request->input('packageID'),
        'packageName' => $request->input('packageName'),
        'subjectQuantity' => $request->input('subjectQuantity'),
        'packagePrice' => $request->input('packagePrice'),
        'eduID' => $request->input('eduID'),
    ]);

    // Redirect to the 'listpackage' route after successful creation
    return redirect()->route('listpackage')->with('success', 'Package created successfully!');
}


    public function update(Request $request, $packageID)
    {
        $package = Package::find($packageID);

        if (!$package) {
            return redirect()->back()->with('error', 'Package not found.');
        }

        $rules = [
            'packageID' => 'required|string|max:10|unique:package,packageID,'.$packageID.',packageID',
            'packageName' => 'required|string|max:100',
            'subjectQuantity' => 'required|integer|min:0',
            'packagePrice' => 'required|numeric|min:0',
            'eduID' => 'required|exists:educationlevel,eduID',
        ];

        $errorMsg = [
            'packageID.required' => 'Package ID is required.',
            'packageID.unique' => 'Package ID is already taken.',
            'packageID.max' => 'The Package ID must not exceed 10 characters.',
            'packageName.required' => 'Package Name is required.',
            'packageName.max' => 'The Package Name must not exceed 100 characters.',
            'subjectQuantity.required' => 'Subject Quantity is required.',
            'subjectQuantity.integer' => 'Subject Quantity must be an integer.',
            'subjectQuantity.min' => 'Subject Quantity must be at least 0.',
            'packagePrice.required' => 'Package Price is required.',
            'packagePrice.numeric' => 'Package Price must be a numeric value.',
            'packagePrice.min' => 'Package Price must be at least start from RM0.',
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $package->update($request->all());

        return redirect()->route('listpackage')->with('success', 'Package updated successfully!');
    }

    public function destroy($packageID)
    {
        // Find the package by its ID
        $package = Package::find($packageID);

        if (!$package) {
            return redirect()->back()->with('error', 'Package not found.');
        }

        // Delete the package
        $package->delete();

        return redirect()->route('listpackage')->with('success', 'Package deleted successfully!');
    }
}

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
    $request->validate([
        'packageID' => 'required|unique:package,packageID|string|max:10',
        'packageName' => 'required|string|max:100',
        'subjectQuantity' => 'required|integer|min:0',
        'packagePrice' => 'required|numeric|min:0',
        'eduID' => 'required|exists:educationlevel,eduID', // Correct the table name to 'educationlevel'
    ]);

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

        $validator = Validator::make($request->all(), [
            'packageID' => 'required|unique:package,packageID|string|max:10',
            'packageName' => 'required|string|max:100',
            'subjectQuantity' => 'required|integer|min:0',
            'packagePrice' => 'required|numeric|min:0',
            'eduID' => 'required|exists:educationlevel,eduID',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
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

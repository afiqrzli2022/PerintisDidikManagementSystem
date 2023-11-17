<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\EducationLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{

    public function adminView(){
        //$studentInfo = Student::all();
        $studentInfo = Student::leftJoin('subscribe as sb', 'student.userID', '=', 'sb.studentID')
        ->where(function ($query) {
            $query->whereNull('sb.subscriptionStatus')
                ->orWhere('sb.subscriptionStatus', '=', 'Active');
        })
        ->orderBy('sb.subscribeDate', 'asc')
        ->select('*')
        ->with('subscribe')
        ->get();    

        return view('admin.subscription', compact('studentInfo'));
    }

    public function adminViewDetail(Request $request){
        $studentDetail = Student::find($request->route('studentID'));
        return view('admin.subscription-details', compact('studentDetail'));
    }

    public function viewSubs(){
        $educationLevel = EducationLevel::all();
        return view('student.subscription', compact('educationLevel'));
    }

    public function addSubscription(Request $request){

        DB::beginTransaction();

        $currentSub = Subscription::find(Auth::user()->student->latestSubs);
        
        if($currentSub){
            
            $currentSub = Subscription::find(Auth::user()->student->latestSubs)->first();
            $currentDate = Carbon::now();
            $currentSubDate = Carbon::parse($currentSub->subscribeDate);
            
            //check month and year if same as current
            if($currentSubDate->year == $currentDate->year && $currentSubDate->month == $currentDate->month){
                $this->editSubscription($request);
                DB::commit();
                session()->flash('success','Successfully update new subscription');
                return redirect()->route('student.subscription');
            } else {
                $currentSub->subscriptionStatus = 'Inactive';
            }
            
        } else {
            $message = 'Successfully subscribe to the package';
        }
        
        $packageID = $request->input('packageID');

        $userID = Auth::user()->userID;

        $Subscription = new Subscription();

        $Subscription -> subscribeID = uniqid();
        $Subscription -> subscribeDate = Carbon::today();
        $Subscription -> subscriptionStatus = 'Active';
        $Subscription -> isPaid = 'No';
        $Subscription -> studentID = $userID;
        $Subscription -> packageID = $packageID;

        $Subscription -> save();

        $selectedSubjects = $request->input('selectedSubjects');

        $Subscription->subject()->attach($selectedSubjects);

        if($currentSub){
            $currentSub->save();
        }

        $Payment = new Payment();
        
        $Payment -> paymentID = uniqid();
        $Payment -> paymentStatus = 'Pending';
        $Payment -> paymentPrice = $Subscription->package->packagePrice;
        $Payment -> packageID = $Subscription->package->packageID;

        $Subscription->payment()->save($Payment);

        DB::commit();

        session()->flash('success', 'Successfully subscribe to the package');
        return redirect()->route('student.subscription');

    }

    public function editSubscription(Request $request){

        $currentSub = Subscription::find(Auth::user()->student->latestSubs->subscribeID);

        $currentSub -> packageID = $request->input('packageID');

        $currentSub->subject()->detach();

        $selectedSubjects = $request->input('selectedSubjects');
        
        $currentSub->subject()->attach($selectedSubjects);

        $currentSub -> save();

        $totalPaid = 0;

        //check currentpaid ;)
        foreach($currentSub->payment->where('paymentStatus','Paid')->pluck('paymentPrice') as $payment){
            $totalPaid = $totalPaid+$payment;
        }

        //check kalau package baru lagi mahal dari totalPaid
        if ($currentSub->package->packagePrice > $totalPaid) {
            
            $unpaidBalance = $currentSub->package->packagePrice - $totalPaid;
            
            //First situation bila kita ada pending (ada yang unpaid)
            if ($currentSub->pendingPayment){
                if($currentSub->pendingPayment->paymentStatus == 'Pending'){
                    $currentPayment = $currentSub->pendingPayment;
                    $currentPayment -> paymentPrice = $unpaidBalance;
                    $currentPayment -> save();
                }

                
            //Second situation bila kita takda pending (dah paid semua)
            } else {
                $payment = new Payment();
                $payment -> paymentID = uniqid();
                $payment -> paymentStatus = 'Pending';
                $payment -> paymentPrice = $unpaidBalance;

                $currentSub->payment()->save($payment);
            }
            
        } else {
            //can make refund value if needed , but still need to learn more, if ada ada
        }
        
        
        //dd("Total Paid", $totalPaid, "UnPaid", $unpaidBalance,"Current Pending", $currentPayment -> paymentPrice);

        return;

    }


}
<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Student;

class PaymentController extends Controller
{

    public function adminView(){
        $currentMonth = Carbon::now()->format('Y-m');
        
        $studentInfo = Student::with(['subscribe.payment' => function ($query) {
            $query->orderBy('payment.paymentStatus', 'desc')
                  ->orderBy('payment.paymentDate', 'asc');
        }])
        ->whereHas('subscribe', function ($query) use ($currentMonth) {
            $query->where('subscriptionStatus', 'Active');
        })
        ->orWhereDoesntHave('subscribe') // Include students without subscriptions
        ->get();

        return view('admin.manage-payment', compact('studentInfo'));

    }
    
    public function adminViewDetail($studentID){
        $studentDetail = Student::with('latestSubs.onepayment')->find($studentID);
        return response()->json($studentDetail);
    }

    public function charge(Request $request)
    {
        $result = Payment::charge($request);

        if(is_array($result) && array_key_exists('error', $result)){
            return redirect()->back()->with('error', $result['error']);
        } else {
            return redirect()->route('student.payment')->with('success', "Payment Success");
        }
    }



    //This is backup that shows all payment for current month
    /*public function adminView(){
        $currentMonth = Carbon::now()->format('Y-m');
        
        $studentInfo =  Student::join('subscribe as sb', 'student.userID', '=', 'sb.studentID')
            ->join('payment as p', 'sb.subscribeID', '=', 'p.subscribeID')
            ->join('package as pg', 'p.packageID', '=', 'pg.packageID')
            ->select('*')
            ->whereYear('sb.subscribeDate', '=', now()->year)
            ->whereMonth('sb.subscribeDate', '=', now()->month)
            ->orderByRaw("CASE WHEN \"p\".\"paymentStatus\" = 'Pending' THEN 0 ELSE 1 END")
            ->orderBy('sb.subscribeDate')
            ->get();
    
        return view('admin.manage-payment', compact('studentInfo'));
    }
    
    public function adminView(){
        $currentMonth = Carbon::now()->format('Y-m');
        
        $studentInfo = Student::with(['subscribe.payment' => function ($query) {
            $query->orderBy('paymentStatus', 'desc')
                  ->orderBy('paymentDate', 'asc');
        }])
        ->whereHas('subscribe', function ($query) use ($currentMonth) {
            $query->where('subscriptionStatus', 'Active');
        })
        ->orWhereDoesntHave('subscribe') // Include students without subscriptions
        ->get();

        $studentInfo->transform(function ($student) {
            if($student->latestSubs){
                    // Sort payments by 'paymentStatus' and 'paymentDate'
                    $sortedPayments = $student->latestSubs->payment->sortByDesc('paymentStatus')->sortBy('paymentDate');
            
                    // Get pending payments
                    $pendingPayments = $sortedPayments->where('paymentStatus', 'Pending');
            
                    if ($pendingPayments->isNotEmpty()) {
                        $student->latestSubs->payments = $pendingPayments;
                    } else {
                        // If no pending payments, take the latest payment
                        $latestPayment = $sortedPayments->last();
                        $student->latestSubs->payments = $latestPayment ? collect([$latestPayment]) : collect();
                    }
            }
            return $student;
        });

        return view('admin.manage-payment', compact('studentInfo'));

    }
    
    */
    
}

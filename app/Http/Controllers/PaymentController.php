<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
    
    public function adminViewDetails($studentID){
        $studentDetail = User::with(
            'student.latestSubs.onePayment',
            'student.latestSubs.package',
            'student.latestSubs.subject'
            )->find($studentID);
        return response()->json($studentDetail);
    }

    public function adminViewDetail(Request $request){
        $studentDetail = Student::find($request->route('studentID'));
        return view('admin.manage-payment-details', compact('studentDetail'));
    }

    public function adminUpdatePayment(Request $request){
        if($request->input('paymentStatus') !== 'Pending'){
            $student = Student::find($request->route('studentID'));
            $payment = Payment::find($student->latestSubs->pendingPayment)->first();
            $subscribe = Subscription::find($payment->subscribeID);

            $payment -> paymentStatus = 'Paid';
            $payment -> paymentDate = Carbon::today();
            $payment -> paymentTime = Carbon::now();
            $payment -> paymentAmount = $payment -> paymentPrice;
            $payment -> paymentMethod = 'Cash';
            $subscribe -> isPaid = 'Yes';
            $subscribe -> adminID = Auth::user()->userID;
            $subscribe -> save();
            $payment -> save();
        }

        return redirect()->route('admin.manage-payment')->with('success', "Payment Status updated");
    }

    public function charge(Request $request)
    {

        $rules = [
            'card-name' => 'required|string|regex:/^[a-zA-Z \']+$/',
            'card-number' => 'required|string|regex:/^\d+$/',
            'mm' => 'required|string|regex:/^\d{2}$/',
            'yy' => 'required|string|regex:/^\d{2}$/',
            'cvc' => 'required|string|regex:/^\d{3}$/',
        ];

        $errorMsg = [
            'card-name' => [
                'required' => 'Cardholder name is required.',
                'regex' => 'Allowed format is alphabet and single quote only.',
            ],
            'card-number' => [
                'required' => 'Card number is required.',
                'regex' => 'Allowed format is digits only.',
            ],
            'mm' => [
                'required' => 'Expiry month is required.',
                'regex' => 'Month format example (MM): 09',
            ],
            'yy' => [
                'required' => 'Expiry year is required.',
                'regex' => 'Year format example (YY): 32',
            ],
            'cvc' => [
                'required' => 'CVC is required.',
                'regex' => 'Please enter CVC with right format (3 digit numbers only).',
            ],
        ];

        $validator = Validator::make($request->all(), $rules, $errorMsg);
    
        if ($validator->fails()) {
            $request->flash();
            return back()->withErrors($validator)->withInput();
        }

        $result = Payment::charge($request);

        if(is_array($result) && array_key_exists('error', $result)){
            $decodedError = html_entity_decode($result['error'], ENT_QUOTES, 'UTF-8');
            return redirect()->route('student.payment')->with('error', $decodedError);
        } else {
            return redirect()->route('student.payment')->with('success', "Payment Success");
        }
    }

    public static function notifyPending(){

        $studentInfo = Student::whereHas('latestSubs.pendingPayment', function ($query) {
            $query->where('paymentStatus', 'Pending');
        })->get();

        $curl = curl_init();
        $token = "chk2QtO5mfr7pzIDRoWWQlkhlRBZtESTijGCR473pTCsuEMVYSfBbna5aNLxub1Z";
        $random = false;
        $payload = $studentInfo->map(function ($student) {
            return [
                'phone' => $student->user->userNumber, // Replace with actual phone number field name
                'message' => 
'Hello '.$student->user->userName.',

This is a friendly reminder regarding your pending payment for the *'.$student->latestSubs->package->packageName.' ('.$student->latestSubs->package->eduID.')* subscription. 

*Payment ID  : '.$student->latestSubs->pendingPayment->paymentID.'*
*Amount      : RM '.$student->latestSubs->pendingPayment->paymentPrice.'*
*Month       : '.\Carbon\Carbon::parse($student->latestSubs->subscribeDate)->format('M y').'.*

Please ensure the payment is made at your earliest convenience to avoid any disruption to your subscription. Thank you! 👍

Your regard,
Perintis Didik
',
            ];
        })->toArray();

        $payload = ['data' => $payload];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
        curl_setopt($curl, CURLOPT_URL,  "https://pati.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

        $resultArray = json_decode($result, true);

        $status = $resultArray['status'];

        if($status === true){
            return redirect()->route('admin.manage-payment')->with('success', "Notification sent to all student with pending payment");
        } else {
            return redirect()->route('admin.manage-payment')->with('success', "Fail to send notification, please try again later");
        }
        
    }
    
}

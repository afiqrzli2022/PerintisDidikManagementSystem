<?php

namespace App\Models;

use Carbon\Carbon;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'paymentID';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['paymentDate','paymentTime'];
    use HasFactory;

    public function Subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscribeID', 'subscribeID');
    }

    public function Package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'packageID', 'packageID');
    }

    public static function charge(Request $request)
    {
        // Set your Stripe API secret key
        $stripe = new StripeClient('sk_test_51MyuYjCPnzqW9CmuNp90YVL6v95rlwnZfetnKKuImnOninXo8A5senMuyInHzlaDKGtqUB7evxu9iJ93jWh97R8o00UHPLkyVR');

        try {
            
            //validation of card input
            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->input('card-number'),
                    'exp_month' => $request->input('mm'),
                    'exp_year' => $request->input('yy'),
                    'cvc' => $request->input('cvc'),
                ],
            ]);
            
            $tokenId = $token->id;
            
            //Changing RM to cents since stripe using cents format ex: for RM1 should use 100
            $stripeAmount = Auth::User() -> student -> latestSubs -> pendingPayment -> paymentPrice*100;
            $month = Carbon::now()->format('M');

            $detail = $stripe->charges->create([
                'amount' => $stripeAmount,
                'currency' => 'myr',
                'source' => $tokenId,
                'description' => 'Name: '.Auth::User()->userName.', '.$month.', Package : '.Auth::User()->student->latestSubs->package->packageName.' ('.Auth::User()->student->latestSubs->package->eduID.')',
            ]);

            $payment = Payment::find(Auth::User() -> student -> latestSubs -> pendingPayment -> paymentID);

            $paymentAmount = $detail -> amount_captured/100;

            if ($detail -> status == 'succeeded'){
                $paymentStatus = 'Paid';
            } else {
                $paymentStatus = 'Failed';
            }

            $payment -> paymentID = $detail -> id;
            $payment -> paymentStatus = $paymentStatus;
            $payment -> paymentAmount = $paymentAmount;
            $payment -> paymentDate = Carbon::today();
            $payment -> paymentTime = Carbon::now();
            $payment -> paymentMethod = 'Online Payment';

            $payment -> save();

            return;
              
        } catch (\Exception $e) {
            // Handle any errors that occurred during the charge process
            if($e->getError()->charge){
                $oldPayment = Payment::find(Auth::User() -> student -> latestSubs -> pendingPayment -> paymentID);
    
                $payment = new Payment();
            
                $payment -> paymentID = uniqid();
                $payment -> paymentStatus = 'Pending';
                $payment -> paymentPrice = $oldPayment->paymentPrice;
                $payment -> subscribeID = $oldPayment->subscribeID;
                $payment -> packageID = $oldPayment->packageID;
                
                $oldPayment -> paymentID = $e->getError()->charge;
                $oldPayment -> paymentStatus = 'Failed';
                $oldPayment -> paymentAmount = 0;
                $oldPayment -> paymentDate = Carbon::today();
                $oldPayment -> paymentTime = Carbon::now();
                $oldPayment -> paymentMethod = 'Online Payment';
                
                $payment->save();
                $oldPayment->save();
            }

            return ['error' => $e->getMessage()];
        }
    }

}

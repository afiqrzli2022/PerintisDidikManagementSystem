<?php

namespace App\Models;

use Carbon\Carbon;
use Stripe\StripeClient;
use Illuminate\Support\Facades\DB;
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

    public static function charge(Request $request)
    {
        // Set your Stripe API secret key
        $stripe = new StripeClient('sk_test_51MyuYjCPnzqW9CmuNp90YVL6v95rlwnZfetnKKuImnOninXo8A5senMuyInHzlaDKGtqUB7evxu9iJ93jWh97R8o00UHPLkyVR');

        try {

            $token = $stripe->tokens->create([
                'card' => [
                    'number' => $request->input('card-number'),
                    'exp_month' => $request->input('mm'),
                    'exp_year' => $request->input('yy'),
                    'cvc' => $request->input('cvc'),
                ],
            ]);
            
            $tokenId = $token->id;

            $detail = $stripe->charges->create([
                'amount' => 10000,
                'currency' => 'myr',
                'source' => $tokenId,
                'description' => 'Name : Matematik, Dec, Package : ', ## FOLLOW SESSION
            ]);

            $payment = new self();

            $payment -> paymentID = $detail -> id;
            $payment -> paymentStatus = $detail -> status;
            $payment -> paymentPrice = $detail -> amount_captured;
            $payment -> paymentAmount = $detail -> amount_captured;
            $payment -> subscribeID = 'sub3'; // CHANGE ######
            $payment -> packageID = 'pkg3'; // CHANGE WITH SESSION ######

            $payment -> save();

            return redirect()->route('student.home');
              
        } catch (\Exception $e) {
            // Handle any errors that occurred during the charge process
            return ['error' => $e->getMessage()];
        }
    }

}

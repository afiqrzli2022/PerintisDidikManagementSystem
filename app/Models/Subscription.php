<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscribe';
    protected $primaryKey = 'subscribeID';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['subscribeDate'];
    use HasFactory;

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentID', 'userID');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'packageID', 'packageID');
    }
    
    public function payment(): HasMany
    {
        return $this->HasMany(Payment::class, 'subscribeID', 'subscribeID');
    }

    public function pendingPayment(): HasOne
    {
        return $this->payment()->one()->where('paymentStatus', 'Pending');
    }

    public function subject(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subscribesubject', 'subscribeID', 'subjectID')
                        ->as('subject');
    }

    public static function checkNumber(){
        $curl = curl_init();
        $token = "CrSX3QbbY1xQfkW30V5Qw88OS7DIn2yZbQctTzM9qiLC50nb7CC0Av5OlRgOzSer";
        $random = true;
        $payload = [
            "data" => [
                [
                    'phone' => '60173551240',
                    'message' => 'Afiq Razali ',
                ]
            ]
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
                "Content-Type: application/json"
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
        curl_setopt($curl, CURLOPT_URL,  "https://solo.wablas.com/api/v2/send-message");
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);
    }
}

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
    
    public function onePayment(): HasOne
    {
        $pendingPayment = $this->payment()->one()->where('paymentStatus', 'Pending') -> first();

        if ($pendingPayment !== null) {
            $pendingPayment = $this->payment()->one()->where('paymentStatus', 'Pending');
            return $pendingPayment;
        }
        
        return $this->payment()->one()->orderBy('paymentTime', 'desc') -> latest('paymentDate');
    
    }

    public function pendingPayment(): HasOne
    {
        return $this->payment()->one()->where('paymentStatus', 'Pending');
    }
    
    public function latestPayment(): HasOne
    {
        return $this->payment()->one()->orderBy('paymentTime', 'desc') -> latest('paymentDate');
    }

    public function subject(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subscribesubject', 'subscribeID', 'subjectID')
                        ->as('subject')
                        ->orderByRaw("CASE 
                        WHEN day = 'Sunday' THEN 1
                        WHEN day = 'Monday' THEN 2
                        WHEN day = 'Tuesday' THEN 3
                        WHEN day = 'Wednesday' THEN 4
                        WHEN day = 'Thursday' THEN 5
                        WHEN day = 'Friday' THEN 6
                        WHEN day = 'Saturday' THEN 7
                        ELSE 8
                    END")
                    ->orderBy('time');
    }
    
}

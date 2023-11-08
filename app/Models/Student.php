<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Student extends Model
{
    use HasFactory;

    protected $table = 'student';
    protected $primaryKey = 'userID';
    public $incrementing = false; // Set to false since userID is not auto-incrementing
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'guardianName',
        'studentAddress',
        'guardianNumber',
    ];

    // Define the inverse one-to-one relationship between Student and User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }

    public function subscribe(): HasMany
    {
        return $this->hasMany(Subscription::class, 'studentID', 'userID');
    }

    public function latestSubs(): HasOne
    {
        return $this->subscribe()->one()->where('subscriptionStatus', 'Active')->latest('subscribeDate');
    }

}
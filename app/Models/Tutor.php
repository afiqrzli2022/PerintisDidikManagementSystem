<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tutor extends Model
{
    use HasFactory;

    protected $table = 'tutor';
    protected $primaryKey = 'userID';
    public $incrementing = false; // Set to false since userID is not auto-incrementing
    protected $keyType = 'string';
    public $timestamps = false;


    protected $fillable = [
        'userID',
        'educationLevel',
        'workingExperience',
    ];

    // Define the inverse one-to-one relationship between Tutor and User
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
    
    public function subject():HasMany
    {
        return $this->hasMany(Subject::class, 'tutorID','userID');
    }
}
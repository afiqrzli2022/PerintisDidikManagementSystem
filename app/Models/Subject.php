<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'subjectID';
    public $incrementing = false; 
    public $timestamps = false;

    protected $fillable = [
        'subjectID',
        'subjectName',
        'time',
        'day',
        'duration',
        'tutorID',
        'eduID',
    ];


    // Define the relationship with EducationLevel model (if it exists)
    public function educationLevel():BelongsTo
    {
        return $this->belongsTo(EducationLevel::class, 'eduID');
    }

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class, 'tutorID');
    }

    public function subscribe(): BelongsToMany
    {
        return $this->belongsTo(Subscription::class, 'subscribesubject', 'subjectID', 'subscribeID')
                        ->as("subscribe");
    }
    
}

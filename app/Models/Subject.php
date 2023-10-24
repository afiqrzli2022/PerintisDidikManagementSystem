<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'userID',
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
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = 'administrator';
    protected $primaryKey = 'userID';
    public $incrementing = false; // Set to false since userID is not auto-incrementing
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'adminRoles',
        'officeNumber',
    ];

    // Define the inverse one-to-one relationship between Administrator and User
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}
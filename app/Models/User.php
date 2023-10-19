<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;  
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model implements Authenticatable
{
    use HasFactory;
    
    protected $table = 'users';
    protected $primaryKey = 'userID';
    public $incrementing = false; // Set to false since userID is not auto-incrementing
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'userID',
        'password',
        'userName',
        'userNumber',
        'userEmail',
        'userCreateDate',
        'userStatus',
        'userType',
    ];

    protected $hidden = [
        'password'
    ];

    // Define the one-to-one relationship between User and Student
    public function student()
    {
        return $this->hasOne(Student::class, 'userID', 'userID');
    }
    
    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'userID', 'userID');
    }
    
    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'userID', 'userID');
    }

    public function getAuthIdentifierName()
    {
        return 'userID'; // Return the name of the primary key column
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->password; // Replace 'password' with the actual column name for the password field in your 'user' table
    }

    // Remember Me functionality
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
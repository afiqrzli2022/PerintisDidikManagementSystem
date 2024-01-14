<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    use HasFactory;
    protected $table ='educationlevel';
    protected $primaryKey ='eduID';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'eduID',
        'eduName'
    ];

    public function Subject()
    {
        return $this->hasMany(Subject::class, 'eduID'); 
    }

    public function Package()
    {
        return $this->hasMany(Package::class, 'eduID')->orderBy('packagePrice', 'asc');
    }

    public function hasPackage()
    {
        return $this->Package()->exists();
    }
}

<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';
    protected $primaryKey = 'packageID';
    public $incrementing = false; 
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'packageID',
        'packageName',
        'subjectQuantity',
        'packagePrice',
        'eduID'
    ];

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class, 'eduID', 'eduID');
    }
}
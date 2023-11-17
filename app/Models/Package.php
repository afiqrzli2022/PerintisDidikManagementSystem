<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasMany;

class Package extends Model
{
    protected $table = 'package';
    protected $primaryKey = 'packageID';
    protected $keyType = 'string';
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
    
    public function subscription():HasMany
    {
        return $this->HasMany(Subscription::class, 'packageID', 'packageID');
    }
}
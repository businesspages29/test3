<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Compnay;
class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';//Firebase
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'status',
    ];
    public function company()
    {
        return $this->belongsTo(Compnay::class, 'company_id');
    }
    public function getStatusAttribute($value)
    {
        if($value){
            return "DeActive";
        }else{
            return "Active";
        }
        
    }
}

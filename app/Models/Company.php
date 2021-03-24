<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';//Firebase
    protected $fillable = [
        'logo',
        'email',
        'website',
        'status',
    ];

    public function getLogoAttribute($value)
    {
        if(isset($value)){
            $imagepath = url('public/app/'.$value);
            
        }else{
            $imagepath =  "https://via.placeholder.com/100";
        }
        return $imagepath;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apply extends Model
{
    use HasFactory;

     protected $fillable = [
        'business_name',
        'finance',
        'cost',
        'user_id',
        'licence',
        'registration_no',
        'date_registered',
        'business_address',
        'portfolio',
        'sms',
        'tender_id' //set as a int
     ];
}

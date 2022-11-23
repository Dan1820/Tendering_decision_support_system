<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tender extends Model
{
    use HasFactory;

   protected $fillable = [
        'tender_name',
        'tender_des',
        'amount',
        'end_date',
   ];
}

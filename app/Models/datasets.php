<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datasets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tender_id',
        'total'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $table = 'surveys'; 

    protected $fillable = [
        'client_type',
        'date',
        'age',
        'sex',
        'office_visited',
        'service',
        'awareness',
        'visibility',
        'helpfulness',
        'SQD0',
        'SQD1',
        'SQD2',
        'SQD3',
        'SQD4',
        'SQD5',
        'SQD6',
        'SQD7',
        'SQD8',
        'comments',
        'email'
    ];
}


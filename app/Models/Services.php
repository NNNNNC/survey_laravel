<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'office_id'];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}

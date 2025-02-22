<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'bn_name',
        'url',
        'upazila_id'
    ];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'firstname', 'date_of_booking', 'user_id', 'email'
    ];

    protected function users()
    {
        return $this->belongsTo(User::class);
    }
}

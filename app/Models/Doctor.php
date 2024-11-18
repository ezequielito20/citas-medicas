<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory;

    private $fillable = [
        'names',
        'last_names',
        'email',
        'phone',
        'medical_leave',
        'specialization',
        'user_id',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function hours(){
        return $this->hasMany(Hour::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

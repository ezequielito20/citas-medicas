<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    /** @use HasFactory<\Database\Factories\DoctorFactory> */
    use HasFactory, HasRoles;

    protected $fillable = [
        'names',
        'last_names',
        'email',
        'phone',
        'medical_leave',
        'specialization',
        'user_id',
        'office_id',
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

    public function events(){
        return $this->hasMany(Event::class);
    }
}

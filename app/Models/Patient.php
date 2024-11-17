<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'names',
        'last_names',
        'ci',
        'email',
        'phone',
        'birthdate',
        'gender',
        'blood_type',
        'allergies',
        'emergency_contact',
        'health_insurance_number',
        'observations',
        'address',
    ];
}

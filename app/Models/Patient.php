<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory, HasRoles;

    protected $guard_name = 'web';
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'amount',
        'payment_date',
        'description'
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2'
    ];

    // Relación con el paciente
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relación con el doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

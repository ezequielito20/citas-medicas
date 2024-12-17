<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    /** @use HasFactory<\Database\Factories\HistorialFactory> */
    use HasFactory;

    protected $fillable = [
        'detail',
        'visit_date',
        'patient_id',
        'doctor_id',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Hour extends Model
{
    /** @use HasFactory<\Database\Factories\HourFactory> */
    use HasFactory, HasRoles;

    protected $fillable = [
        'day',
        'start_time',
        'end_time', 
        'doctor_id',
        'office_id',
    ];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function office(){
        return $this->belongsTo(Office::class);
    }
}

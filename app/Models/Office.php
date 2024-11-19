<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    /** @use HasFactory<\Database\Factories\OfficeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'capacity',
        'phone',
        'specialization',
        'status',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function hours(){
        return $this->hasMany(Hour::class);
    }
}

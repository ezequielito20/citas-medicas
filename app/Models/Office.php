<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Office extends Model
{
    /** @use HasFactory<\Database\Factories\OfficeFactory> */
    use HasFactory, HasRoles;

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
    public function events(){
        return $this->hasMany(Event::class);
    }
}

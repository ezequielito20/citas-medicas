<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Secretary extends Model
{
    use HasRoles;
    protected $fillable = [
        'names',
        'last_names',
        'ci',
        'phone',
        'birthdate',
        'address',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
        
}

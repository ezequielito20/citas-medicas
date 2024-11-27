<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Secretary extends Model
{
    use HasRoles;
    protected $fillable = [
        // $table->string('names', length: 100);
        //     $table->string('last_names', length: 100);
        //     $table->string('ci', length: 9)->unique();
        //     $table->string('phone')->nullable();
        //     $table->string('birthdate', length: 100)->nullable();
        //     $table->string('address', length: 190)->nullable();

        //     $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'address',
        'phone',
        'sex',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payment() {
        return $this->hasMany(Payment::class);
    }
}
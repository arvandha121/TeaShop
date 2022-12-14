<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'employee_id',
        'payment',
        'change',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'menu_id',
        'order_id',
        'token',
        'qty',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}
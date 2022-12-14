<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id';
    
    protected $fillable =[
        'name',
        'price',
        'stock',
        'menu_photo_path',
    ];

    public function orderDetails() {
        return $this->hasMany(OrderDetial::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_products',
        'product_id',
        'client_id'

    ];

    public function clients (){
        return $this->hasOne(Client::class);
    }
    public function products (){
        return $this->hasMany(Product::class);
    }

}

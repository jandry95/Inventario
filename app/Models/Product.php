<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'productsName',
        'productsStock',
        'productsDescription',
        'category_id'

    ];
         
    public function categories (){
        return $this->hasOne(Category::class);
    }
}

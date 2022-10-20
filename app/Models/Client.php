<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'ci',
        'address',
        'phone',


    ];

    public function sales (){
        return $this->belongsTo(Sales::class);
    }
}

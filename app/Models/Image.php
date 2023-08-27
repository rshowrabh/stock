<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'int_no',
        'type',
    ];
    function stocksIn(){
        return $this->hasMany('App\StocksIn');
    }
}

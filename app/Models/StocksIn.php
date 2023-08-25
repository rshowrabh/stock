<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StocksIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'int_no',
        'date',
        'quantity',
        'price',
        'image_id',
        'category_id',
        'comment',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function stocksOut(): HasOne
    {
        return $this->hasOne(StocksOut::class, 'item_id');
    }
}

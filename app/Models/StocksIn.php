<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;

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
    public function getStocksLeftAttribute() // notice that the attribute name is in CamelCase.
    {
    return $this->quantity - ($this->stocksOut->quantity ?? '0');
    }
}

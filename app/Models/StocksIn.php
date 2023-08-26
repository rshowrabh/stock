<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StocksIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'int_no',
        'date',
        'quantity',
        'price',
        'image_id',
        'comment',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
    public function stocksOut(): HasMany
    {
        return $this->hasMany(StocksOut::class, 'item_id');
    }
    public function getStocksLeftAttribute() // notice that the attribute name is in CamelCase.
    {
    return $this->quantity - ($this->stocksOut->quantity ?? '0');
    }
    public function getStocksInTotalAttribute() // notice that the attribute name is in CamelCase.
    {
    return havingRaw('sum(quantity) > ?');
    }
}

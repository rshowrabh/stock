<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'comment',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function stocksIn(): HasMany
    {
        return $this->hasMany(StocksIn::class, 'item_id');
    }
    public function stocksOut(): HasMany
    {
        return $this->hasMany(StocksOut::class, 'item_id');
    }
    public function getStocksInTotalAttribute()
    {
    return $this->stocksIn->sum('quantity');
    }
    public function getStocksOutTotalAttribute()
    {
    return $this->stocksOut->sum('quantity');
    }
    public function getStocksLeftAttribute()
    {
    return ($this->stocksIn->sum('quantity')- $this->stocksOut->sum('quantity'));
    }
}

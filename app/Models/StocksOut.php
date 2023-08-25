<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class StocksOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'member_id',
        'image_id',
        'date',
        'int_no',
        'quantity',
        'comment',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
    public function items(): BelongsTo
    {
        return $this->belongsTo(StocksIn::class ,'item_id');
    }
}

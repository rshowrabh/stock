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
    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class,'int_no', 'int_no')->where('images.type','=', 'out');
    }
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
    
}

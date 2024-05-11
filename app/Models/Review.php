<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'rating',

    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(User::class);
    }
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Product::class);
    }
}

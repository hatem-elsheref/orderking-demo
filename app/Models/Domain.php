<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['merchant_id', 'domain'];

    public function merchant() :BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}

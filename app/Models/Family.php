<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    /** @use HasFactory<\Database\Factories\FamilyFactory> */
    use HasFactory;

    protected $fillable = ['id', 'name', 'order_id'];

    public function order(): BelongsTo {
        return $this->belongsTo(Order::class);
    }

    public function insects(): HasMany {
        return $this->hasMany(Insect::class);
    }
}

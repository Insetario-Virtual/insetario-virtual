<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Insect extends Model
{
    /** @use HasFactory<\Database\Factories\InsectFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'scientific_name',
        'order_id',
        'family_id',
        'predator',
        'importance',
        'morphology'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function commonNames(): HasMany
    {
        return $this->hasMany(CommonName::class);
    }

    public function cultures(): BelongsToMany
    {
        return $this->belongsToMany(Culture::class, 'insect_culture');
    }

    public function images(): HasMany
    {
        return $this->hasMany(InsectImage::class);
    }
}

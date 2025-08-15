<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function families(): HasMany {
        return $this->hasMany(Family::class);
    }

    public function insects(): HasMany {
        return $this->hasMany(Insect::class);
    }
}

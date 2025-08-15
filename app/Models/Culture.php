<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Culture extends Model
{
    /** @use HasFactory<\Database\Factories\CultureFactory> */
    use HasFactory;
    
    protected $fillable = ['id', 'name'];

    public function insects(): BelongsToMany
    {
        return $this->belongsToMany(Insect::class, 'insect_culture');
    }
}

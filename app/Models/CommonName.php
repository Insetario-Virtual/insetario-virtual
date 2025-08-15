<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommonName extends Model
{
    /** @use HasFactory<\Database\Factories\CommonNameFactory> */
    use HasFactory;

    protected $fillable = ['id', 'insect_id', 'name'];

    public function insect(): BelongsTo
    {
        return $this->belongsTo(Insect::class);
    }
}

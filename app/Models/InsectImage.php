<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsectImage extends Model
{
    /** @use HasFactory<\Database\Factories\InsectImageFactory> */
    use HasFactory;

    protected $fillable = ['id', 'insect_id', 'image_path'];

    public function insect(): BelongsTo
    {
        return $this->belongsTo(Insect::class);
    }
}

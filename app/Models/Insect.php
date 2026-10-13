<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage; // Importar para usar o Storage::url/asset

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

    /**
     * Format a scientific name for display without changing the stored value.
     */
    public static function formatScientificName(?string $name): string
    {
        $name = trim((string) $name);

        if ($name === '') {
            return '';
        }

        $name = mb_strtolower($name, 'UTF-8');

        return mb_strtoupper(mb_substr($name, 0, 1, 'UTF-8'), 'UTF-8')
            . mb_substr($name, 1, null, 'UTF-8');
    }

    public function getFormattedScientificNameAttribute(): string
    {
        return self::formatScientificName($this->scientific_name);
    }

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

    public function firstImage(): HasOne
    {
        return $this->hasOne(InsectImage::class)->oldestOfMany();
    }

    public function getImagePathAttribute(): string
    {
        $imagePath = optional($this->firstImage)->image_path;

        if ($imagePath) {
            return 'storage/' . $imagePath;
        }

        return 'storage/icons/insetario.png';
    }
}

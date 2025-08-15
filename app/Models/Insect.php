<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

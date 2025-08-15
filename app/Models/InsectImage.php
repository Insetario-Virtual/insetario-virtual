<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsectImage extends Model
{
    /** @use HasFactory<\Database\Factories\InsectImageFactory> */
    use HasFactory;

    protected $fillable = ['id', 'insect_id', 'culture_id'];
}

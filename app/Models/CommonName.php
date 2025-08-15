<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonName extends Model
{
    /** @use HasFactory<\Database\Factories\CommonNameFactory> */
    use HasFactory;

    protected $fillable = ['id', 'insect_id', 'name'];
}

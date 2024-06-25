<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // Ensure 'id' is included here
        'name',
        'description',
        // Add other fields that you want to be fillable
        'image', // Add 'image' to the fillable array
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = ['firstname','lastname','email', 'question']; // Ajout de 'question' aux champs remplissables

    // ...
}


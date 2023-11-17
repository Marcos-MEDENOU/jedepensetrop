<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'question']; // Ajout de 'question' aux champs remplissables

    // ...
}


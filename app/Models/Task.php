<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Agrega 'category_id' a los atributos rellenables
    protected $fillable = ['title', 'description', 'category_id']; 

    // Define la relación con la categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'category_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
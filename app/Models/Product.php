<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_id',
        'name_en',
        'description_id',
        'description_en',
        'category',
        'price',
        'image',
    ];

    public function wishlistedBy()
{
    return $this->belongsToMany(User::class, 'wishlists')
        ->withTimestamps();
}

}

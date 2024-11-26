<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'price',
        'description',
        'kategori_id'
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}

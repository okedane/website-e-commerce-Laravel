<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected  $fillable = [
        'title',
        'description',
        'image'
    ];

    public function produks()
    {
        return $this->belongsTo(produks::class);
    }
}

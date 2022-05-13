<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'biography', 'text_color', 'background_color', 'youtube_1', 'youtube_2', 'youtube_3'
    ];

    public static function searchBand($keyword) {
        return Band::where('name', 'LIKE', "%$keyword%")->orWhere('description', 'LIKE', "%$keyword%")->get();
      }
}

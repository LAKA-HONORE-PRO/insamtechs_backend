<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestModel extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['titre', 'body'];

    protected $fillable = ['titre', 'body'];

    // protected $casts = [
    //     'translations' => 'json',
    // ];

}

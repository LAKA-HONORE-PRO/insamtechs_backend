<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Composer extends Model
{
    use HasFactory;
    // use HasTranslations;

    // public $translatable = ['reponse'];


    protected $fillable = [
        'user_id',
        'formation_id',
        'question_id',
        'reponse',
        'date',
    ];

    // public function generateSlug()
    // {
    //     $this->slug = Str::slug($this->intitule);
    // }
}

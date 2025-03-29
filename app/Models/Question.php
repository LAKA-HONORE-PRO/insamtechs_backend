<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = [
        'intitule',
        'question_une',
        'question_deux',
        'question_trois', 
        'question_quatre', 
        'bonne_reponse',
    ]; 



    protected $fillable = [
        'intitule',
        'nombre_de_points',
        'question_une',
        'question_deux',
        'question_trois',
        'question_quatre',
        'bonne_reponse',
        'slug',
    ];

    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    use HasTranslations;


    public $translatable = ['intitule', 'reponse'];


    protected $fillable = [
        'intitule',
        'reponse',
        'lien',//Stocker le lien d'explication
    ];


}

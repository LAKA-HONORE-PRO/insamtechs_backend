<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reponse extends Model
{
    use HasFactory;
    use HasTranslations;

    
    public $translatable = [
        'intitule',
    ]; 



    protected $fillable = [
        'question_id',
        'intitule',
    ];

}

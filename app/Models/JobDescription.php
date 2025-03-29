<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobDescription extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['intitule', 'prix', 'langue_formation'];

    protected $fillable = [

        'categorie_id',
        'type_formation_id',
        'intitule',
        'description',
        'langue_formation',
        'prix',
        'lien',
        'nombre_de_points',
        'duree',
        'duree_composition',
        'date',
        'slug',
        'telechargeable',

    ];



    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule.'-'.Hash::make($this->id));
    }
}

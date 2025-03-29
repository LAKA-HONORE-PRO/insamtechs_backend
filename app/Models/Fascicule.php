<?php

namespace App\Models;

// use App\Models\Chapitre;
// use App\Models\Question;
// use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
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

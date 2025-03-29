<?php

namespace App\Models;

use App\Models\Formation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['intitule'];


    protected $fillable = [
        'intitule',
        'type',
        'date',
        'slug',
    ];

    public function formations() {
        return $this->hasMany(Formation::class);
    }


    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule.'-'.Hash::make($this->id));

    }


}
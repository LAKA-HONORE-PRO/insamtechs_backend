<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['intitule'];

    protected $fillable = [
        'chapitre_id',
        'intitule',
        'lien',
        'date',
        'slug',
    ];



    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule.'-'.$this->id);
    }
}

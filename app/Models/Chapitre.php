<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chapitre extends Model
{
    use HasFactory;
    use HasTranslations;


    public $translatable = ['intitule'];


    protected $fillable = [
        'formation_id',
        'intitule',
        'slug',
    ];


    public function videos(){
        return $this->hasMany(Video::class);
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule.'-'.$this->id);
    }
}

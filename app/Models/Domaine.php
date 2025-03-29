<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domaine extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['intitule'];


    protected $fillable = [

        'intitule',
        'date',
        'slug',

    ];


    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule.'-'.Hash::make($this->id));
    }
}

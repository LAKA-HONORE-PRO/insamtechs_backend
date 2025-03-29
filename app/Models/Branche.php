<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['intitule'];

    protected $fillable = [
        'intitule',
        'slug'
    ];


    public function generateSlug()
    {
        $this->slug = Str::slug($this->intitule.'-'.Hash::make($this->id));

    }
}

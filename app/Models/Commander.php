<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commander extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'formation_id',
        'telephone',
        'identifiant_transaction',
        'etat_commande',
        'date',
        'slug',
    ];


    public function generateSlug()
    {
        $this->slug = Str::slug($this->user_id.$this->formation_id.'commande');
    }

    
}

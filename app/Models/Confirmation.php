<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Confirmation extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['r1', 'r2', 'r3', 'observation'];


    protected $fillable = [
        'user_id',
        'video_id',
        'r1',
        'r2',
        'r3',
        'observation',
        'num_attestation'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telechargements extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'formation_id', 'date'];
}

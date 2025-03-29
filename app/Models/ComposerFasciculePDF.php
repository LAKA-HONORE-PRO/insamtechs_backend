<?php

namespace App\Models;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComposerFasciculePDF extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'formation_id',
        'booklet_link'
    ];

    protected $with = ['formation', 'user'];

    public function formation(){
        return $this->belongsTo(Formation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

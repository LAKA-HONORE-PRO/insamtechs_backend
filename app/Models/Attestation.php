<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formation;
use App\Models\User;

class Attestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'formation_id',
        'user_id',
        'certificate_number'
    ];


    protected $with = ['formation', 'user'];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php
namespace App\Imports;

use App\Models\Formation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class JobDescriptionImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        set_time_limit(300);
        

        $languages = ['fr', 'en'];
        $prix = '0';
        $langue = 'français';
        $description = 'Jobs';

        return new Formation([
            'categorie_id' => 367,
            'type_formation_id' => 4,
            'intitule' => $row['nom'],
            'description' => $description,
            'langue_formation' => $langue,
            'prix' => $prix,
            'lien' => $row['liens'],
            'nombre_de_points' => '20',
            'date' => date('d.m.Y'),
            'slug' => Str::slug($row['nom'].'-'.Hash::make(1)),
            'etat' => 1,
            'telechargeable' => 0
        ]);
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
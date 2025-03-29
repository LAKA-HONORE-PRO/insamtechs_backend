<?php

namespace App\Imports;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VideoImport implements ToModel, WithHeadingRow
{
 /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row['chapitre_id']);
        $intitule = 'Introduction';
        // $translationIntitule = [];
        // $languages = ['fr', 'en'];

        // foreach ($languages as $language) {
        //     $translate = new GoogleTranslate($language);
        //     $translatedIntitule = $translate->translate($row[0]);
        //     $translationIntitule[$language] = $translatedIntitule;
        // }

        $video = new Video([
            'chapitre_id' => $row['chapitre_id'],
            'intitule' => $intitule,
            'lien'=>$row['lien_de_la_formation'],
            // 'lien'=>$row['lien'],
            'date'=>date('d.m.Y'),
            'slug'=>Str::slug($intitule.'-'.Hash::make(1)),
        ]);

        $video->save();

        // $slug = Str::slug($intitule.'-'.Hash::make($chapitre->id));
        // $chapitre->slug = $slug;

        // return $chapitre;
    }
}

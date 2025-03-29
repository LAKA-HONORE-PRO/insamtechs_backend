<?php

namespace App\Imports;

use App\Models\Chapitre;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class ChapitreImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $intitule = 'chapitre 1';
        // $translationIntitule = [];
        // $languages = ['fr', 'en'];

        // foreach ($languages as $language) {
        //     $translate = new GoogleTranslate($language);
        //     $translatedIntitule = $translate->translate($row[0]);
        //     $translationIntitule[$language] = $translatedIntitule;
        // }

        $chapitre = new Chapitre([
            'formation_id' => $row[0],
            'intitule' => 'chapitre 1',
            'slug'=>Str::slug($intitule.'-'.Hash::make(1)),
        ]);

        $chapitre->save();

        // $slug = Str::slug($intitule.'-'.Hash::make($chapitre->id));
        // $chapitre->slug = $slug;

        // return $chapitre;
    }
}

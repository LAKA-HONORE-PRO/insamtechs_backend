<?php

namespace App\Imports;

use App\Models\Categorie;
// use App\Models\Formation;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FasciculesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $translationIntitule = [];
        $languages = ['fr', 'en'];


        // Vérifier si la ligne est la première ligne (ligne d'en-tête)
        if ($row[0] === 'intitule') {
            return null; // Ignorer la première ligne d'en-tête
        }

        foreach ($languages as $language) {
            $translate = new GoogleTranslate($language);
            $translatedIntitule = $translate->translate($row[0]);
            $translationIntitule[$language] = $translatedIntitule;
        }

        $categorie = new Categorie([
            'intitule' => $translationIntitule,
            'type' => $row[1],
            'date' => $row[2]
        ]);

        $categorie->save();

        $slug = Str::slug($translationIntitule['fr'] . '-' . $categorie->id);
        $categorie->slug = $slug;

        return $categorie;
    }
}

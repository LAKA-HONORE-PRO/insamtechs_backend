<?php

namespace App\Imports;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CategoriesImport implements ToModel
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

        // foreach ($languages as $language) {
        //     $translate = new GoogleTranslate($language);
        //     $translatedIntitule = $translate->translate($row[0]);
        //     $translationIntitule[$language] = $translatedIntitule;
        // }

     
            $categorie = new Categorie([
                'intitule' => strtolower($row[0]),
                'type' => 2,
                'date' => date('d.m.Y'),
            ]);
    
            $categorie->save();
    
            $slug = Str::slug($row[0].'-'.Hash::make($categorie->id));
            $categorie->slug = $slug;
    
            return $categorie;


    }
}

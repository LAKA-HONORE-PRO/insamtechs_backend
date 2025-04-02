<?php
use App\Models\Faq;
use App\Models\Attestation;
use App\Models\Domaine;
use App\Models\Chapitre;
use App\Models\Question;
use App\Models\Categorie;
use App\Models\Commander;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TestController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\VidController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtatController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\FichierController;
use App\Http\Controllers\ChapitreController;
use App\Http\Controllers\ComposerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\ExamenJobController;
use App\Http\Controllers\FasciculeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\JobQuestionController;
use App\Http\Controllers\BibliothequeController;
use App\Http\Controllers\ComposerFasciculeController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\ConfirmationController;
use App\Models\Branche;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([

    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

], function(){
    

    Route::get('/', function () {

        return view('pages.Accueil', ['categoriesvideos'=>Categorie::where('type', 1)->inRandomOrder()->orderBy('id', 'desc')->take(6)->get(), 'fascicules'=>Categorie::where(['type'=>3])->inRandomOrder()->take(4)->get(), 'faqs'=>Faq::all(), 'livres'=>Categorie::where('type',2)->inRandomOrder()->take(6)->get()]);
    })->name('accueil');

/*
Route::get('/videotheque', function () {
    return view('pages.Videotheque', ['categories'=>Categorie::where('type',1)->paginate(6), 'cats'=>Categorie::where('type',1)->orderBy('id', 'desc')->get(), 'formations'=>Formation::where(['type_formation_id'=>1])->take(13)->get()]);
})->name('videotheque');
*/


// ACCEDER A LA VIDEOTHE FR OU EN

Route::get('videotheque/{lang}', function ($lang) {
    $langue = '';

    if($lang == 'fr'){
        $langue = 'français';
        $l = '{"fr":"français","en":"French"}';
    }else{
        $langue = 'anglais';
        $l = '{"fr":"anglais","en":"anglais"}';
    }

   // dd($langue);
    return view('pages.Videotheque', ['categories'=>Categorie::where(['type'=>1, 'langue'=>$langue])->orderBy('intitule', 'asc')->paginate(9), 'cats'=>Categorie::where(['type'=>1, 'langue'=>$langue])->orderBy('id', 'desc')->get(), 'formations'=>Formation::where(['type_formation_id'=>1, 'langue_formation'=>$l])->take(13)->get(), 'lang'=>$lang]);
})->name('videotheque');




Route::get('fichiers/{nomFichier}', [FichierController::class, 'afficherFichier'])->name('fichier.show');



Route::get('/bibliotheque/{lang}', function ($lang) {

    if($lang == 'fr'){
        $langue = 'français';
      $l = '{"fr":"français"}';
    }else{
        $langue = 'anglais';
        $l = '{"en":"anglais"}';

    }


    return view('pages.Bibliotheque', ['cats'=>Categorie::where(['type'=>2, 'langue'=>$langue])->orderBy('id', 'desc')->get(), 'categories'=>Categorie::where(['type'=>2, 'langue'=>$langue])->paginate(9), 'livres'=>Formation::where(['type_formation_id'=>2, 'langue_formation'=>$l])->orderby('id', 'desc')->take(13)->get(), 'lang'=>$lang]);
})->name('bibliotheque');



Route::get('/detailsbibliotheque/{slug}', function ($slug) {

    $categorie = Categorie::where('slug', $slug)->first();
    $livres = Formation::where(['categorie_id'=> $categorie->id, 'type_formation_id'=>2])->get();

    return view('pages.DetailBibliotheque', ['categorie'=>$categorie, 'livrescat'=>$livres, 'cats'=>Categorie::where('type',2)->orderBy('id', 'desc')->get(), 'categories'=>Categorie::where('type',2)->paginate(9), 'livres'=>Formation::where(['type_formation_id'=>2])->orderby('id', 'desc')->take(13)->get()]);
})->name('detailbibliotheque');


Route::get('/formations/{slug}', function (string $slug) {

    $formation = Formation::where(['slug'=>$slug])->first();
    $langueActive = LaravelLocalization::getCurrentLocale();

    // dd($langueActive);
    // $chapitres = Chapitre::where(['formation_id'=>$formation->id])->skip(1)->get();

    // Récupérer tous les chapitres excepté le premier
            $chapitres = DB::table('chapitres')
                            ->select(DB::raw('JSON_EXTRACT(intitule, "$.'.$langueActive.'") AS titre, id'))
                            ->where('formation_id', $formation->id)
                            ->whereRaw('id != (SELECT MIN(id) FROM chapitres WHERE formation_id = ?)', [$formation->id])
                            ->whereRaw('JSON_EXTRACT(intitule, "$.'.$langueActive.'") IS NOT NULL')
                            ->get();

                            // dd($chapitres);

                            // dd($chapitres);
    //Fin Récupérer tous les chapitres excepté le premier




    $premiere_video = DB::table('videos')
    ->join('chapitres', 'chapitres.id', '=', 'videos.chapitre_id')
    ->join('formations', 'formations.id', '=', 'chapitres.formation_id')
    ->where(['formations.id'=> $formation->id])
    ->select(DB::raw('JSON_EXTRACT(videos.intitule, "$.'.$langueActive.'") AS titre'), 'videos.*')
    ->first();

   // dd($premiere_video);
    return view('pages.Formation', ['formation'=>$formation, 'chapitres'=>$chapitres, 'premiere_video'=>$premiere_video, 'formations'=>Formation::where(['type_formation_id'=>1])->orderBy('id', 'desc')->take(13)->get()]);
})->name('formation');



Route::get('/details/{slug}/{lang}', function (string $slug, string $lang) {

    if($lang == 'fr'){
        $langue = 'français';
      $l = '{"fr": "français", "en": "français"}';
    }else{
        $langue = 'anglais';
        $l = '{"fr": "anglais", "en": "anglais"}';
    }

    $categorie = Categorie::where(['slug'=>$slug])->first();
    $formations = Formation::where(['categorie_id'=>$categorie->id, 'type_formation_id'=>1])->paginate(9);

    return view('pages.DetailsCategorie', ['categorie'=>$categorie, 'formations'=>$formations, 'cats'=>Categorie::where(['type'=>1, 'langue'=>$langue])->orderBy('id', 'desc')->take(13)->get(), 'formats'=>Formation::where(['type_formation_id'=>1, 'langue_formation'=>$l])->orderBy('id', 'desc')->take(25)->get(), 'lang'=>$lang]);
})->name('details');



Route::get('/detailscategorieslivres/{slug}/{lang}', function (string $slug, string $lang) {
    $langue = '';
    if($lang == 'fr'){
        $langue = 'français';
      $l = '{"fr":"français"}';
    }else{
        $langue = 'anglais';
        $l = '{"en":"anglais"}';
    }


    $categorie = Categorie::where(['slug'=>$slug])->first();

    $livres = Formation::where(['categorie_id'=>$categorie->id, 'type_formation_id'=>2])->paginate(9);

    // dd($formations);

    return view('pages.DetailsCategoriesLivres', ['categorie'=>$categorie, 'livres'=>$livres, 'cats'=>Categorie::where(['type'=>2, 'langue'=>$langue])->orderBy('id', 'desc')->get(), 'bibliotheques'=>Formation::where(['type_formation_id'=>2, 'langue_formation'=>$l])->orderBy('id', 'desc')->take(13)->get(), 'lang'=>$lang]);
})->name('detailscategorieslivres');



Route::get('/detailslivre/{slug}/{lang}', function (string $slug, string $lang) {
    
    $langue = '';
    if($lang == 'fr'){
        $langue = 'français';
    }else{
        $langue = 'anglais';
    }

    $livre = Formation::where(['slug'=>$slug, 'type_formation_id'=>2])->first();

    return view('pages.DetailLivre', ['livre'=>$livre]);
})->name('detailslivre');


Route::get('/download_url/{slug}', [BibliothequeController::class, 'telechargerfichier'])->name('telecharger_fichier');


Route::get('/download_livre/{slug}', [BibliothequeController::class, 'telechargerLivre'])->name('telecharger_livre');


Route::get('/contact', function () {
    return view('pages.Contact');
})->name('contact');



Route::get('/panier', function () {

    $user = Auth::user();

    return view('pages.Panier', ['paniers'=>Commander::where(['user_id'=>$user->id, 'etat_commande'=>0])->get(), 'formations'=>Formation::where(['type_formation_id'=>1])->orderBy('id', 'desc')->take(4)->get()]);
})->name('panier')->middleware('auth');



Route::get('/cc', function () {
    return view('pages.Filieres', ['branches'=>Branche::paginate(6), 'cats'=>Branche::orderBy('id', 'desc')->get(),]);
})->name('filieres');


Route::get('/fascicules/{slug}', function ($slug) {
    $branche = Branche::where('slug', $slug)->first();
    return view('pages.SeriesFascicules', ['domaines'=>Domaine::where('branche_id', $branche->id)->orderBy('id', 'DESC')->paginate(6), 'cats'=>Domaine::where('branche_id', $branche->id)->orderBy('intitule', 'ASC')->get(),]);
})->name('fasc');


Route::get('/detailsseries/{slug}', function ($slug) {

    $domaine = Domaine::where('slug', $slug)->first();
    $categories = Categorie::where(['domaine_id'=> $domaine->id, 'type'=>3])->paginate(9);

    return view('pages.Fascicule', ['categories'=>$categories, 'domaine'=>$domaine, 'cats'=>Categorie::where('type',3)->orderBy('id', 'desc')->get(), 'domaines'=>Domaine::all()]);
})->name('detailsseries');



Route::get('/detailsfascicule/{slug}', function ($slug) {

    $categorie = Categorie::where('slug', $slug)->first();
    $fascicules = Formation::where(['categorie_id'=> $categorie->id, 'type_formation_id'=>3])->paginate(9);

    return view('pages.DetailFascicule', ['categorie'=>$categorie, 'fascicules'=>$fascicules, 'cats'=>Categorie::where('type',3)->orderBy('id', 'desc')->get(), 'categories'=>Categorie::where('type',3)->paginate(6), 'livres'=>Formation::where(['type_formation_id'=>3])->orderby('id', 'desc')->get()]);
})->name('detailsfascicule');



Route::get('/read_file_fascicule/{slug}', [FasciculeController::class, 'hideDownloadReadFile'])->name('hide_download_read_file'); //Lecteur de fichier dans le iframe
Route::get('/read_file', function(){
    return View('pages.ReadFile');
})->name('read_file');



Route::get('/jobDescription', function () {
    return view('pages.JobDescription', ['categories'=>Categorie::where('type',4)->paginate(6), 'cats'=>Categorie::where('type',4)->orderBy('id', 'desc')->get()]);
})->name('jobs');




Route::get('/detailsjobs/{slug}', function ($slug) {

    $categorie = Categorie::where('slug', $slug)->first();
    $fascicules = Formation::where(['categorie_id'=> $categorie->id, 'type_formation_id'=>4, 'etat'=>1])->paginate(9);

    return view('pages.DetailJob', ['categorie'=>$categorie, 'fascicules'=>$fascicules, 'cats'=>Categorie::where('type',4)->orderBy('id', 'desc')->get(), 'categories'=>Categorie::where('type',4)->paginate(6), 'livres'=>Formation::where(['type_formation_id'=>4])->orderby('id', 'desc')->take(14)->get()]);
})->name('detailsjobs');









Route::get('/mesformations', function () {

    $user = Auth::user();

    return view('pages.MesFormations', ['formations'=>Formation::where(['type_formation_id'=>1])->orderBy('id', 'desc')->take(4)->get(), 'paniers'=>Commander::where(['user_id'=>$user->id, 'etat_commande'=>0])->get(), 'mes_formations'=>Commander::where(['user_id'=>Auth::user()->id, 'etat_commande'=>1])->get()]);
})->name('mesformations')->middleware('auth');



Route::get('/connexion', function () {
    return view('pages.Connexion');
})->name('connexion');



Route::get('/lecteur/{slug}', function (string $slug) {

    $formation = Formation::where('slug', $slug)->first();

    // dd($formation);
    return view('pages.Lecteur', ['lien'=>$formation->lien, 'formation'=>$formation]);
})->name('lecteur');



    //FASCICULE EXAMEN

Route::get('/examen_fasc/{slug}', [ComposerController::class, 'index'])->name('examen_fasc')->middleware('auth');
Route::post('/examen_fasc_store', [ComposerController::class, 'getNextQuestion'])->name('store_examen_fasc')->middleware('auth');
Route::get('/take_fasc/{id}', [ComposerController::class, 'take'])->name('take_fasc');
Route::get('/note_fasc/{idformation}', [ComposerController::class, 'note'])->name('note_fasc')->middleware('auth');
Route::get('/resultat_fasc/{slug}', [ComposerController::class, 'resultat'])->name('resultat_fasc')->middleware('auth');
Route::get('/delete_fasc/{slug}', [ExamenJobController::class, 'delete'])->name('composer_fasc_delete')->middleware('auth');

    //FIN FASCICULE EXAMEN



    //JOB DESCRIPTION  EXAMEN


    Route::get('/examen_job/{slug}', [ExamenJobController::class, 'index'])->name('examen_job')->middleware('auth');
    Route::post('/examen_job_store', [ExamenJobController::class, 'getNextQuestion'])->name('store_examen_job')->middleware('auth');
    Route::get('/take_job/{id}', [ExamenJobController::class, 'take'])->name('take_job');
    Route::get('/note_job/{idformation}', [ExamenJobController::class, 'note'])->name('note_job')->middleware('auth');
    Route::get('/resultat_job/{slug}', [ExamenJobController::class, 'resultat'])->name('resultat_job')->middleware('auth');
    Route::get('/delete_job/{slug}', [ExamenJobController::class, 'delete'])->name('composer_job_delete')->middleware('auth');


    //FIN JOB DESCRIPTION  EXAMEN




Route::get('/profile', function () {
    return view('pages.Profil');
})->name('profile')->middleware('auth');



Route::get('/dashbord', function () {
    return view('pages.Dash');
})->name('dashboard')->middleware('auth');



Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
Route::post('/signin', [AuthController::class, 'doInscription'])->name('doInscription');
Route::post('/newsletter_form', [NewsletterController::class, 'newsletter_form'])->name('newsletter_form');


// LES ROUTES EN RESSOURCE


Route::resource('composer', ComposerController::class)->middleware('auth');
Route::resource('categorie', CategorieController::class)->middleware('auth');
Route::resource('faq', FaqController::class)->middleware('auth');
Route::resource('formation', FormationController::class)->middleware('auth');
Route::resource('fascicule', FasciculeController::class)->middleware('auth');
Route::resource('job', JobController::class)->middleware('auth');
Route::resource('bibliotheques', BibliothequeController::class)->middleware('auth');
Route::resource('confirmation', ConfirmationController::class)->middleware('auth');
Route::resource('video', VideoController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('domaine', DomaineController::class)->middleware('auth');
Route::resource('branche', BrancheController::class)->middleware('auth');
Route::resource('composer_fascicule_pdf', ComposerFasciculeController::class)->middleware('auth');
Route::resource('newsletter', NewsletterController::class);

Route::get('logout',[AuthController::class,'logout'])->name('auth.logout');


// FIN DES ROUTES EN RESSOURCE



//Supprimer fascicule

        Route::get('/supprimer_fascicule/{slug}', [FasciculeController::class, 'destroy'])->name('supprimer_fascicule')->middleware('auth');
        Route::POST('/update_etat_fascicule', [FasciculeController::class, 'update_etat'])->name('update_etat_fascicule')->middleware('auth');

//Fin Supprimer fascicule



    // ROUTES CHAPITRE

    Route::get('/chapitre/{slug}', [ChapitreController::class, 'chapitre_create'])->name('create_chapitre')->middleware('auth');

    Route::post('/chapitre_store', [ChapitreController::class, 'chapitre_store'])->name('store_chapitre')->middleware('auth');

    Route::get('/chapitre_index/{slug}', [ChapitreController::class, 'chapitre_index'])->name('chapitre_index')->middleware('auth');

    Route::get('/chapitre_edit/{id}', [ChapitreController::class, 'chapitre_edit'])->name('chapitre_edit')->middleware('auth');

    Route::get('/chapitre_delete/{id}', [ChapitreController::class, 'chapitre_delete'])->name('chapitre_delete')->middleware('auth');

    Route::post('/chapitre_update', [ChapitreController::class, 'chapitre_update'])->name('chapitre_update')->middleware('auth');

    //FIN ROUTES CHAPITRE



    // ROUTES VIDEOS

    
        Route::get('/video_create/{id}', [VidController::class, 'video_create'])->name('create_video')->middleware('auth');

        Route::post('/video_store', [VidController::class, 'video_store'])->name('store_video')->middleware('auth');

        Route::get('/video_index/{id}', [VidController::class, 'video_index'])->name('video_index')->middleware('auth');
    
        Route::get('/video_edit/{id}', [VidController::class, 'video_edit'])->name('video_edit')->middleware('auth');

        Route::get('/video_delete/{id}', [VidController::class, 'video_delete'])->name('video_delete')->middleware('auth');
    
        Route::post('/video_update', [VidController::class, 'video_update'])->name('video_update')->middleware('auth');


    //FIN ROUTES VIDEO





        // ROUTES CHAPITRE

        Route::get('/question/{slug}', [QuestionController::class, 'question_create'])->name('create_question')->middleware('auth');

        Route::post('/question_store', [QuestionController::class, 'question_store'])->name('store_question')->middleware('auth');
    
        Route::get('/question_index/{slug}', [QuestionController::class, 'question_index'])->name('question_index')->middleware('auth');
    
        Route::get('/question_edit/{id}', [QuestionController::class, 'question_edit'])->name('question_edit')->middleware('auth');
    
        Route::post('/question_update', [QuestionController::class, 'question_update'])->name('question_update')->middleware('auth');
    
        //FIN ROUTES CHAPITRE



                // ROUTES CHAPITRE

                Route::get('/questionjob/{slug}', [JobQuestionController::class, 'question_create'])->name('create_questionjob')->middleware('auth');

                Route::get('/questionjobone/{slug}', [JobQuestionController::class, 'question_create_one'])->name('createone_questionjob')->middleware('auth');

                Route::post('/questionjob_store', [JobQuestionController::class, 'question_store'])->name('store_questionjob')->middleware('auth');

                Route::post('/questionjobone_store', [JobQuestionController::class, 'question_store_one'])->name('storeone_questionjob')->middleware('auth');

            
                Route::get('/questionjob_index/{slug}', [JobQuestionController::class, 'question_index'])->name('questionjob_index')->middleware('auth');
            
                Route::get('/questionjob_edit/{id}', [JobQuestionController::class, 'question_edit'])->name('questionjob_edit')->middleware('auth');

                Route::get('/questionjob_delete/{id}', [JobQuestionController::class, 'question_delete'])->name('questionjob_delete')->middleware('auth');
            
                Route::post('/questionjob_update', [JobQuestionController::class, 'question_update'])->name('questionjob_update')->middleware('auth');
            
                //FIN ROUTES CHAPITRE



        // ROUTES DE LA TABLE COMMANDER

        Route::get('/commande/{slug}', [CommanderController::class, 'commande_create'])->name('create_commande')->middleware('auth');
        Route::get('/delete/{slug}', [CommanderController::class, 'commande_delete'])->name('delete_commande')->middleware('auth');


        // FIN ROUTES DE LA TABLE COMMANDER



        // ROUTES DE MODIFICATION DU PROFIL COTE CLIENT

        Route::post('update_parametre', [UserController::class, 'update_profil'])->name('update_profil')->middleware('auth');
        Route::post('update_profil_for_attestation', [UserController::class, 'update_profil_for_attestation'])->name('update_profil_for_attestation')->middleware('auth');

        Route::post('update_password', [UserController::class, 'update_password'])->name('update_password')->middleware('auth');

        // FIN ROUTES DE MODIFICATION DU PROFIL COTE CLIENT

        Route::get('/videos_par_categorie', function () {
            return view('pages.admin.etat.VideosParCategorieForm', ['categories'=>Categorie::where('type',1)->get()]);
        })->name('videos_par_categories')->middleware('auth');


        Route::get('/formations_videos_par_categories', function () {
            return view('pages.admin.etat.formationsVideosParCategorie', ['categories'=>Categorie::where('type',1)->get()]);
        })->name('formations_videos_par_categories')->middleware('auth');


        
        
        Route::post('/videoscategorie', [EtatController::class, 'index'])->name('indexvidescategories')->middleware('auth');
        
        Route::post('/formationsvideoscategorie', [EtatController::class, 'indexForm'])->name('indexFormationsVideosCategories')->middleware('auth');

        
        Route::get('/fascicules_par_categorie', function () {
            return view('pages.admin.etat.FasciculesParCategorie', ['categories'=>Categorie::where('type',3)->orderBy('intitule', 'ASC')->with('formations')->get()]);
        })->name('fascicules_par_categorie')->middleware('auth');

        Route::post('/fasciculescategorie', [EtatController::class, 'fasciculescategorie'])->name('fasciculescategorie')->middleware('auth');


        Route::post('type_document', [EtatController::class, 'ajax_type_document'])->name('ajax_type_document');
        Route::post('fichier', [EtatController::class, 'fichier_input'])->name('fichier_input');


        Route::get('import', [FasciculeController::class, 'import_vue'])->name('import_vue');
        Route::post('import_create', [FasciculeController::class, 'import_save'])->name('import_save');

        Route::get('import_categories', [CategorieController::class, 'import_vue'])->name('import_categories');
        Route::post('import_categorie_create', [CategorieController::class, 'import_save'])->name('import_categorie_create');


        Route::get('import_job', [JobController::class, 'import_vue'])->name('import_job');
        Route::post('import_job_create', [JobController::class, 'import_save'])->name('import_job_create');


        Route::get('import_formation', [FormationController::class, 'import_vue'])->name('import_formation');
        Route::post('import_formation_create', [FormationController::class, 'import_save'])->name('import_formation_create');


        Route::get('import_chapitre', [ChapitreController::class, 'import_vue'])->name('import_chapitre');
        Route::post('import_chapitre_create', [ChapitreController::class, 'import_save'])->name('import_chapitre_create');


        Route::get('/jobs_par_categorie', function () {
            return view('pages.admin.etat.JobParCategorie', ['categories'=>Categorie::where('type',4)->get()]);
        })->name('jobs_par_categorie')->middleware('auth');


        Route::post('/jobscategorie', [EtatController::class, 'jobscategorie'])->name('jobscategorie')->middleware('auth');


        
        Route::get('/etat_global_livres', function () {
            return view('pages.admin.etat.EtatGlobLivres', ['categories'=>Categorie::where('type',2)->get()]);
        })->name('etat_global_livres')->middleware('auth');

        Route::post('/etatGlobalLivres', [EtatController::class, 'etatGlobalLivres'])->name('etatGlobalLivre')->middleware('auth');

        
        Route::get('import_video', [VidController::class, 'import_vue'])->name('import_video');
        Route::post('import_video_create', [VidController::class, 'import_save'])->name('import_video_create');

        Route::get('update_state/{id}', [UserController::class, 'update_state'])->name('update_state');





        // BARRES DE RECHERCHES VIDEOTHEQUES

            //recherche catégorie vidéothèques
                Route::get('videotheque_search/{lang}', function (Request $request, $lang) {
                    $langue = '';
                    if($lang == 'fr'){
                        $langue = 'français';
                    }else{
                        $langue = 'anglais';
                    }
                    $searchTerm = $request->get('search');
                    $categories = Categorie::where('intitule', 'like', '%'.$searchTerm.'%')
                                            ->where('type', '=', 1)
                                            ->where('langue', '=', $langue)
                                            ->paginate(30);
                // dd($categories);
                // dd($langue);
                    return view('pages.Videotheque', ['categories'=>$categories, 'cats'=>Categorie::where(['type'=>1, 'langue'=>$langue])->orderBy('id', 'desc')->get(), 'formations'=>Formation::where(['type_formation_id'=>1, 'langue_formation'=>$langue])->take(13)->get(), 'lang'=>$lang, 'search'=>$searchTerm]);
                })->name('categorie_videotheque_search');
        //FIN BARRES DE RECHERCHES catégorie vidéothèques



                    //recherche détails catégorie vidéothèques
                    Route::get('details_cat_vid/{slug}', function (Request $request, string $slug) {
                        $langue = '';
                        if($request->lang == 'fr'){
                            $langue = 'français';
                            $l = '{"fr": "français", "en": "français"}';
                        }else{
                            $langue = 'anglais';
                            $l = '{"fr": "anglais", "en": "anglais"}';
                        }
                      
                        $searchTerm = $request->get('search');

                        $categorie = Categorie::where(['slug'=>$slug])->first();

                        $formations = Formation::where('intitule', 'like', '%'.$searchTerm.'%')
                                                ->where('type_formation_id', '=', 1)
                                               // ->where('categorie_id', '=', $categorie->id)
                                                ->paginate(30);

                    // dd($langue);
                        return view('pages.DetailsCategorie', ['categorie'=>$categorie, 'formations'=>$formations, 'cats'=>Categorie::where(['type'=>1, 'langue'=>$langue])->orderBy('id', 'desc')->take(13)->get(), 'formats'=>Formation::where(['type_formation_id'=>1, 'langue_formation'=>$l])->orderBy('id', 'desc')->take(13)->get(), 'lang'=>$request->lang, 'search'=>$searchTerm]);
                    })->name('details_categorie_videotheque_search');
            //FIN BARRES DE RECHERCHES détails catégorie vidéothèques


            //FIN BARRE DE RECHERCHE VIDEOTHEQUE




            //BARRE DE RECHERCHE Bibliotheque

                    //recherche catégorie vidéothèques
                    Route::get('bibliotheque_search/{lang}', function (Request $request, $lang) {
                        $langue = '';
                        if($lang == 'fr'){
                            $langue = 'français';
                        }else{
                            $langue = 'anglais';
                        }

                        
                        $searchTerm = $request->get('search');
                        $categories = Categorie::where('intitule', 'like', '%'.$searchTerm.'%')
                                                ->where('type', '=', 2)
                                                ->where('langue', '=', $langue)
                                                ->paginate(100);
                    // dd($categories);
                    // dd($langue);
                        return view('pages.Bibliotheque', ['cats'=>Categorie::where(['type'=>2, 'langue'=>$langue])->orderBy('id', 'desc')->get(), 'categories'=>$categories, 'livres'=>Formation::where(['type_formation_id'=>2, 'langue_formation'=>$langue])->orderby('id', 'desc')->take(13)->get(), 'lang'=>$lang, 'search'=>$searchTerm]);
                    })->name('categorie_bibliotheque_search');
                    //FIN BARRES DE RECHERCHES catégorie vidéothèques



                        //recherche détails catégorie vidéothèques
                        Route::get('details_cat_bibliotheque/{slug}', function (Request $request, string $slug) {
                            $langue = '';
                            if($request->lang == 'fr'){
                                $langue = 'français';
                            }else{
                                $langue = 'anglais';
                            }
                        
                            $searchTerm = $request->get('search');
                            $categorie = Categorie::where(['slug'=>$slug])->first();

                            $livres = Formation::where('intitule', 'like', '%'.$searchTerm.'%')
                                                    ->where('type_formation_id', '=', 2)
                                                   // ->where('categorie_id', '=', $categorie->id)
                                                    ->get();

                        // dd($langue);
                            return view('pages.DetailsCategoriesLivres', ['categorie'=>$categorie, 'livres'=>$livres, 'cats'=>Categorie::where(['type'=>2, 'langue'=>$langue])->orderBy('id', 'desc')->get(), 'bibliotheques'=>Formation::where(['type_formation_id'=>2, 'langue_formation'=>$langue])->orderBy('id', 'desc')->take(13)->get(), 'lang'=>$request->lang, 'search'=>$searchTerm]);
                        })->name('details_categorie_bibliotheque_search');
                    //FIN BARRES DE RECHERCHES détails catégorie vidéothèques

           // FIN BARRE DE RECHERCHE BIBLIOTHEQUE


           Route::get('/liste_attestation/{slug}', function($slug){
            $formation = Formation::where('slug', $slug)->first();
            $studies = Attestation::where('formation_id', $formation->id)->get();
            
            return view('pages.ListeAttestation', ['studies'=>$studies, 'formation'=>$formation]);

           })->name('liste_attestations');


           Route::get('/attestation/{slug}', function($slug){

            $formation = Formation::where('slug', $slug)->first();
            $user = Auth::user();

            $attestation = Attestation::where(['formation_id'=>$formation->id, 'user_id'=>$user->id])->first();

            $data = URL::to('/liste_attestation/'.$formation->slug);    
            $qrCode = QrCode::size(110)->generate($data);
                return view('pages.Attestation', ['qrCode'=>$qrCode, 'formation'=>$formation, 'attestation'=>$attestation]);
           })->name('getAttestation');
});


Route::fallback(function () {
    return view('404.404');
})->name('404');
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

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
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

App::setLocale('fr');

//GET URL
Route::get('/', [\App\Http\Controllers\CampController::class,'Camp'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Camp-details/{id?}',[\App\Http\Controllers\CampController::class,'DetailsCamp'])->middleware(['auth', 'verified'])->name('CampDetails');

Route::get('/Collaborateur-page', [\App\Http\Controllers\CollaborateurController::class,'Collaborateur'])->middleware(['auth', 'verified'])->name('Collaborateur');

Route::get('/Materiel-page',[\App\Http\Controllers\MaterielController::class,'Materiel'])->middleware(['auth', 'verified'])->name('Materiel');

Route::get('/Liste-materiel-page',[\App\Http\Controllers\MaterielController::class,'MaterielListe'])->middleware(['auth', 'verified'])->name('MaterielListe');

Route::get('/Ajout-info-camp/{id?}',[\App\Http\Controllers\CampController::class,'Addinfo'])->middleware(['auth', 'verified'])->name('AjoutInfoCamp');

Route::get('/Details-Materiels/{id?}',[\App\Http\Controllers\MaterielController::class,'DetailsMateriel'])->middleware(['auth', 'verified'])->name('DetailsMateriel');

Route::get('/Ajout-Recolte-page/{id?}',[\App\Http\Controllers\CampController::class,'AddRecolte'])->middleware(['auth', 'verified'])->name('AjoutRecolte');

Route::get('/Calendrier-Recolte-Page',[\App\Http\Controllers\CampController::class,'Recolte'])->middleware(['auth', 'verified'])->name('CalendrierRecolte');

Route::get('/Details-Recolte-page/{id?}',[\App\Http\Controllers\CampController::class,'DetailsRecolte'])->middleware(['auth', 'verified'])->name('DetailsRecolte');

Route::get('/Delete-Culture/{id?}',[\App\Http\Controllers\CampController::class,'dropCulture'])->middleware(['auth', 'verified'])->name('DeleteCulture');

Route::get('/Liste-don-argent',[\App\Http\Controllers\MaterielController::class,'ArgentListe'])->middleware(['auth', 'verified'])->name('argentliste');

Route::get('/Depense/{id?}',[\App\Http\Controllers\CampController::class,'Depense'])->middleware(['auth', 'verified'])->name('Depense');

Route::get('/Recensement',[\App\Http\Controllers\CampController::class,'Recensement'])->middleware(['auth', 'verified'])->name('Recensement');

Route::get('/Message',[\App\Http\Controllers\MessageController::class,'Message'])->middleware(['auth', 'verified'])->name('message');

Route::get('/conversion/{user?}',[\App\Http\Controllers\MessageController::class,'Conversation'])->middleware(['auth', 'verified'])->name('Conversation');

Route::get('/Culture-liste',[\App\Http\Controllers\CultureController::class,'Culture'])->middleware(['auth', 'verified'])->name('Culture');

Route::get('/Formluaire-Culture',[\App\Http\Controllers\CultureController::class,'NewCulture'])->middleware(['auth', 'verified'])->name('NewCulture');

Route::get('/Update-culture/{id?}',[\App\Http\Controllers\CultureController::class,'updateCulture'])->middleware(['auth', 'verified'])->name('UpdateCulture');

Route::get('/supprimer-culture/{id?}',[\App\Http\Controllers\CultureController::class,'DropCulture'])->middleware(['auth', 'verified'])->name('dropCulture');

Route::get('/export-materiel/{id?}',[\App\Http\Controllers\MaterielController::class,'MaterielExport'])->middleware(['auth', 'verified'])->name('exportMateriel');

Route::get('/Materiel-Liste-Tout',[\App\Http\Controllers\MaterielController::class,'MaterielAll'])->middleware(['auth', 'verified'])->name('AllMateriel');

Route::get('/Materile-Export-All',[\App\Http\Controllers\MaterielController::class,'MaterielAllExport'])->middleware(['auth', 'verified'])->name('ExportAllMateriel');

Route::get('/Model-culture-Excel',[\App\Http\Controllers\CultureController::class,'ModelCulture'])->middleware(['auth', 'verified'])->name('ModelCulture');

Route::get('/Argent-Export',[\App\Http\Controllers\MaterielController::class,'ArgenExport'])->middleware(['auth', 'verified'])->name('ArgentExport');

Route::get('/Materiel-Pdf',[\App\Http\Controllers\MaterielController::class,'MaterielAllPDF'])->middleware(['auth', 'verified'])->name('MaterielAllPDF');

//POST URL
Route::post('/Form-Ajout-Sortie-culture',[\App\Http\Controllers\CampController::class,'SortieCulture'])->middleware(['auth', 'verified'])->name('FormAjoutSortieCulture');

Route::post('/Form-Ajout-Collaborateur',[\App\Http\Controllers\CollaborateurController::class,'SaveCollaborateur'])->middleware(['auth', 'verified'])->name('SaveCollaborateur');

Route::post('/Form-Ajout-Materiel',[\App\Http\Controllers\MaterielController::class,'SaveMateriel'])->middleware(['auth', 'verified'])->name('SaveMateriel');

Route::post('/Form-Ajout-CampCollab',[\App\Http\Controllers\CampController::class,'CampCollab'])->middleware(['auth', 'verified'])->name('CampCollab');

Route::post('/Form-Ajout-Don',[\App\Http\Controllers\CampController::class,'Dons'])->middleware(['auth', 'verified'])->name('Dons');

Route::post('/Form-Ajout-recolte',[\App\Http\Controllers\CampController::class,'SaveRecolte'])->middleware(['auth', 'verified'])->name('SaveRecolte');

Route::post('/send',[\App\Http\Controllers\MessageController::class,'sendMessage'])->middleware(['auth', 'verified'])->name('send');

Route::post('/Depense-date',[\App\Http\Controllers\CampController::class,'DepenseDate'])->middleware(['auth', 'verified'])->name('DepenseDate');

Route::post('/Ajout-culture',[\App\Http\Controllers\CultureController::class,'AddCulture'])->middleware(['auth', 'verified'])->name('AjoutCulture');

Route::post('/Modifier-culture',[\App\Http\Controllers\CultureController::class,'FormUpdateCulture'])->middleware(['auth', 'verified'])->name('ModifierCulture');

Route::post('/Form-Ajout-culture-camp',[\App\Http\Controllers\CampController::class,'AddCultureCamp'])->middleware(['auth', 'verified'])->name('SaveCulture');

Route::post('/import-Culure',[\App\Http\Controllers\CultureController::class,'ImportCulture'])->middleware(['auth', 'verified'])->name('ImportCulture');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

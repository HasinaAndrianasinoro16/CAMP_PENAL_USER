<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::get('/Recensement',[\App\Http\Controllers\CampController::class,'Recensement'])->middleware(['auth', 'verified'])->name('Recensement');

//POST URL11
Route::post('/Form-Ajout-Collaborateur',[\App\Http\Controllers\CollaborateurController::class,'SaveCollaborateur'])->middleware(['auth', 'verified'])->name('SaveCollaborateur');

Route::post('/Form-Ajout-Materiel',[\App\Http\Controllers\MaterielController::class,'SaveMateriel'])->middleware(['auth', 'verified'])->name('SaveMateriel');

Route::post('/Form-Ajout-CampCollab',[\App\Http\Controllers\CampController::class,'CampCollab'])->middleware(['auth', 'verified'])->name('CampCollab');

Route::post('/Form-Ajout-Don',[\App\Http\Controllers\CampController::class,'Dons'])->middleware(['auth', 'verified'])->name('Dons');

Route::post('/Form-Ajout-recolte',[\App\Http\Controllers\CampController::class,'SaveRecolte'])->middleware(['auth', 'verified'])->name('SaveRecolte');

Route::post('/Form-Ajout-culture-camp',[\App\Http\Controllers\CampController::class,'AddCultureCamp'])->middleware(['auth', 'verified'])->name('SaveCulture');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

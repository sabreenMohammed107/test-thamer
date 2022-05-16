<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return Redirect::to('/login');
});

Auth::routes();

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    //case route
    Route::resource('cases', 'App\Http\Controllers\CasesController');
    //CoutrController
    Route::resource('courts', 'App\Http\Controllers\CoutrController');
    Route::get('dynamicBranch/fetch', 'App\Http\Controllers\CasesController@fetchUsers')->name('dynamicBranch.fetch');
    Route::get('dynamicCases/search', 'App\Http\Controllers\CasesController@search')->name('dynamicCases.search');
    Route::get('dynamicCasesAdmin/searchAdmin', 'App\Http\Controllers\CasesController@searchAdmin')->name('dynamicCasesAdmin.searchAdmin');

    Route::get('add-client', 'App\Http\Controllers\CasesController@saveClient')->name('add-client');
    Route::get('add-opponent', 'App\Http\Controllers\CasesController@saveOppontent')->name('add-opponent');
    Route::post('attach-client', 'App\Http\Controllers\CasesController@attachClient')->name('attach-client');
    Route::post('attach-opponent', 'App\Http\Controllers\CasesController@attachOppontent')->name('attach-opponent');
    Route::get('editClient/search', 'App\Http\Controllers\CasesController@editClient')->name('editClient.search');
    Route::get('editOpponent/search', 'App\Http\Controllers\CasesController@editOpponent')->name('editOpponent.search');
//archiveCase
Route::post('archiveCase', 'App\Http\Controllers\CasesController@archiveCase')->name('archiveCase');

    //case members
    Route::resource('case-member', 'App\Http\Controllers\CaseMembersController');
    //regulation
    Route::resource('regulation', 'App\Http\Controllers\RegulationController');
    Route::post('regulationDone', 'App\Http\Controllers\RegulationController@done')->name('regulationDone');

  //diary
  Route::resource('diary', 'App\Http\Controllers\DairyController');
  Route::post('diaryDone', 'App\Http\Controllers\DairyController@done')->name('diaryDone');

   //letter
   Route::resource('letter', 'App\Http\Controllers\LetterController');
   Route::post('letterDone', 'App\Http\Controllers\LetterController@done')->name('letterDone');

     //petition
     Route::resource('petition', 'App\Http\Controllers\PetitionController');
     Route::post('petitionDone', 'App\Http\Controllers\PetitionController@done')->name('petitionDone');
       //session
       Route::resource('session', 'App\Http\Controllers\SessionController');
         //attachment
         Route::resource('attachment', 'App\Http\Controllers\AttachmentController');
          //fees
          Route::resource('fees', 'App\Http\Controllers\FeesController');
          //all showing

 Route::get('un-finish', 'App\Http\Controllers\ShowSettingsController@unfinish')->name('un-finish');
 Route::get('finish', 'App\Http\Controllers\ShowSettingsController@finish')->name('finish');
 Route::get('court-comming', 'App\Http\Controllers\ShowSettingsController@courtComming')->name('court-comming');
 Route::get('court-old', 'App\Http\Controllers\ShowSettingsController@courtOld')->name('court-old');
 Route::get('show-dision/{id}', 'App\Http\Controllers\ShowSettingsController@showDision')->name('show-dision');
 Route::get('dision', 'App\Http\Controllers\ShowSettingsController@dision')->name('dision');

 Route::get('show-client/{id}', 'App\Http\Controllers\ShowSettingsController@showClient')->name('show-client');
 Route::get('client', 'App\Http\Controllers\ShowSettingsController@clients')->name('client');

 Route::get('show-Oppenont/{id}', 'App\Http\Controllers\ShowSettingsController@showoppenont')->name('show-Oppenont');
 Route::get('Oppenont', 'App\Http\Controllers\ShowSettingsController@Oppenonts')->name('Oppenont');
//reports

Route::get('/fun', [App\Http\Controllers\FunController::class, 'document']);
Route::get('html-pdf', 'App\Http\Controllers\FunController@htmlPdf')->name('htmlPdf');


Route::resource('presdure', 'App\Http\Controllers\PresdureController');
//procedDone
Route::post('procedDone', 'App\Http\Controllers\PresdureController@done')->name('procedDone');

//memberReferral
Route::get('createReferral/{id}', 'App\Http\Controllers\PresdureController@createReferral')->name('createReferral');
Route::post('memberReferral', 'App\Http\Controllers\PresdureController@memberReferral')->name('memberReferral');
 //regulationReport
 Route::get('regulationReport/{id}', 'App\Http\Controllers\RegulationController@report')->name('regulationReport');
  //diaryReport
  Route::get('diaryReport/{id}', 'App\Http\Controllers\DairyController@report')->name('diaryReport');
   //letterReport
   Route::get('letterReport/{id}', 'App\Http\Controllers\LetterController@report')->name('letterReport');
    //petitionReport
    Route::get('petitionReport/{id}', 'App\Http\Controllers\PetitionController@report')->name('petitionReport');
  //petition
  Route::resource('contract', 'App\Http\Controllers\ContractController');

 //petition
 Route::resource('archive', 'App\Http\Controllers\CaseArchiveController');
});

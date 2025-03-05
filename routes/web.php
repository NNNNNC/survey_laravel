<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

// Default route for the survey introduction page
Route::get('/', [SurveyController::class, 'show'])->name('survey.intro');
Route::get('/survey/step1', [SurveyController::class, 'form1'])->name('survey.step1');
Route::post('/survey/step1', [SurveyController::class, 'storeStep1'])->name('survey.storeStep1');

Route::get('/survey/step2', [SurveyController::class, 'form2'])->name('survey.step2');
Route::post('/survey/step2', [SurveyController::class, 'storeStep2'])->name('survey.storeStep2');

Route::get('/survey/step3', [SurveyController::class, 'form3'])->name('survey.step3');
Route::post('/survey/step3', [SurveyController::class, 'storeFinal'])->name('survey.storeFinal');


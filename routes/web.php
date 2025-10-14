<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileConverterController;
use App\Http\Controllers\TranslatorController;


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

Route::get('/', [Controller::class, 'index'])->name('dashboard');
Route::get('/translator', [TranslatorController::class, 'index'])->name('translator');
Route::get('/converter', function () 
{ return view('fileconverter');})->name('converter');
Route::post('/convert-word-to-pdf', [FileConverterController::class, 'convertWordToPdf'])->name('convert.word.to.pdf');
Route::post('/convert-pdf-to-word', [FileConverterController::class, 'convertPdfToWord'])->name('convert.pdf.to.word');
Route::get('/show-pdf', [FileConverterController::class, 'showPdf'])->name('show.pdf');

// Comment out catch-all route to avoid conflicts
// Route::get('/{any?}', function () {
//     return view('welcome');
// })->where('any', '.*');
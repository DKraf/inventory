<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ExceleController;


Route::get('/', function () {return view('home');})->middleware('auth');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


Route::put('/equipment/send', [EquipmentController::class, 'send'])->middleware('auth');
Route::get('/equipment/sendshow', [EquipmentController::class, 'sendshow'])->middleware('auth');
Route::put('/equipment/take', [EquipmentController::class, 'take'])->middleware('auth');
Route::get('/equipment/takeshow', [EquipmentController::class, 'takeshow'])->middleware('auth');
Route::resource('equipment', EquipmentController::class)->middleware('auth');


Route::get('/history/eqreport', [HistoryController::class, 'index'])->middleware('auth');
Route::get('/history/movereport', [HistoryController::class, 'movereport'])->middleware('auth');
Route::get('/history/dateinput', [HistoryController::class, 'dateinput'])->middleware('auth');


Route::get('/excel/history', [ExceleController::class, 'downloadhistory'])->middleware('auth');
Route::get('/excel/equip', [ExceleController::class, 'downloadequip'])->middleware('auth');
Route::resource('excel', ExceleController::class)->middleware('auth');

Route::resource('history', historyController::class);

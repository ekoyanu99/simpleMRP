<?php

use App\Http\Controllers\BomMstrController;
use App\Http\Controllers\ItemMstrController;
use App\Http\Controllers\MrpDetController;
use App\Http\Controllers\MrpMstrController;
use App\Http\Controllers\OdmMstrController;
use App\Http\Controllers\PoDetController;
use App\Http\Controllers\PoMstrController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesDetController;
use App\Http\Controllers\SalesMstrController;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ItemMstr
    Route::resource('ItemMstrs', ItemMstrController::class);
    Route::get('/ItemMstr/json', [ItemMstrController::class, 'data'])->name('ItemMstr.data');
    Route::get('ItemMstr/{itemMstrId}/delete', [ItemMstrController::class, 'destroy']);
    // BomMstr
    Route::resource('BomMstrs', BomMstrController::class);
    Route::get('/BomMstr/json', [BomMstrController::class, 'data'])->name('BomMstr.data');
    Route::get('BomMstr/{bomMstrId}/delete', [BomMstrController::class, 'destroy']);
    // OdmMstr
    Route::resource('OdmMstrs', OdmMstrController::class);
    Route::get('/OdmMstr/json', [OdmMstrController::class, 'data'])->name('OdmMstr.data');
    Route::get('OdmMstr/{odmMstrId}/delete', [OdmMstrController::class, 'destroy']);
    // MrpMstr
    Route::resource('MrpMstrs', MrpMstrController::class);
    Route::get('/MrpMstr/json', [MrpMstrController::class, 'data'])->name('MrpMstr.data');
    Route::get('MrpMstr/{mrpMstrId}/delete', [MrpMstrController::class, 'destroy']);
    // MrpDet
    Route::resource('MrpDets', MrpDetController::class);
    Route::get('/MrpDet/json', [MrpDetController::class, 'data'])->name('MrpDet.data');
    Route::get('MrpDet/{mrpDetId}/delete', [MrpDetController::class, 'destroy']);
    // SalesMstr
    Route::resource('SalesMstrs', SalesMstrController::class);
    Route::get('/SalesMstr/json', [SalesMstrController::class, 'data'])->name('SalesMstr.data');
    Route::get('SalesMstr/{salesMstrId}/delete', [SalesMstrController::class, 'destroy']);
    // SalesDet
    Route::resource('SalesDets', SalesDetController::class);
    Route::get('/SalesDet/json', [SalesDetController::class, 'data'])->name('SalesDet.data');
    Route::get('SalesDet/{salesDetId}/delete', [SalesDetController::class, 'destroy']);
    // PoMstr
    Route::resource('PoMstrs', PoMstrController::class);
    Route::get('/PoMstr/json', [PoMstrController::class, 'data'])->name('PoMstr.data');
    Route::get('PoMstr/{poMstrId}/delete', [PoMstrController::class, 'destroy']);
    // PoDet
    Route::resource('PoDets', PoDetController::class);
    Route::get('/PoDet/json', [PoDetController::class, 'data'])->name('PoDet.data');
    Route::get('PoDet/{poDetId}/delete', [PoDetController::class, 'destroy']);

    Route::get('GetDesc/{itemId}', [ItemMstrController::class, 'getDesc']);
});

require __DIR__ . '/auth.php';

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

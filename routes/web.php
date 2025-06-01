<?php

use App\Http\Controllers\BomMstrController;
use App\Http\Controllers\InDetController;
use App\Http\Controllers\ItemMstrController;
use App\Http\Controllers\MrpDetController;
use App\Http\Controllers\MrpMstrController;
use App\Http\Controllers\OdmMstrController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PoDetController;
use App\Http\Controllers\PoMstrController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesDetController;
use App\Http\Controllers\SalesMstrController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // ItemMstr
    Route::resource('ItemMstrs', ItemMstrController::class);
    Route::get('/ItemMstr/json', [ItemMstrController::class, 'data'])->name('ItemMstr.data');
    Route::get('ItemMstr/{itemMstrId}/delete', [ItemMstrController::class, 'destroy']);
    Route::get('ItemMstrList/export', [ItemMstrController::class, 'export'])->name('ItemMstrList.export');

    // BomMstr
    Route::resource('BomMstrs', BomMstrController::class);
    Route::get('/BomMstr/json', [BomMstrController::class, 'data'])->name('BomMstr.data');
    Route::get('BomMstr/{bomMstrId}/delete', [BomMstrController::class, 'destroy']);

    // Bom Calculator
    Route::get('/BomMstr/calculator', [BomMstrController::class, 'showCalculatorForm'])->name('BomMstr.calculator');
    Route::post('/BomMstr/calculate', [BomMstrController::class, 'calculateBom'])->name('BomMstr.calculate');

    // OdmMstr
    Route::resource('OdmMstrs', OdmMstrController::class);
    Route::get('/OdmMstr/json', [OdmMstrController::class, 'data'])->name('OdmMstr.data');
    Route::get('OdmMstr/{odmMstrId}/delete', [OdmMstrController::class, 'destroy']);
    // MrpMstr
    Route::resource('MrpMstrs', MrpMstrController::class);
    Route::get('/MrpMstr/json', [MrpMstrController::class, 'data'])->name('MrpMstr.data');
    Route::get('/MrpMstr/detail/{id}', [MrpMstrController::class, 'detailData'])->name('MrpMstr.detailData');
    Route::get('MrpMstr/{mrpMstrId}/delete', [MrpMstrController::class, 'destroy']);

    // genearte MRP
    Route::post('/MrpMstr/generateMrp', [MrpMstrController::class, 'generateMrp'])->name('MrpMstr.generateMrp');


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


    // InDet
    Route::resource('InDets', InDetController::class);
    Route::get('/InDet/json', [InDetController::class, 'data'])->name('InDet.data');
    Route::get('InDet/{inDetId}/delete', [InDetController::class, 'destroy']);

    // role mstr
    Route::resource('RoleMstrs', RoleController::class);
    Route::get('RoleMstrList', [RoleController::class, 'index'])->name('RoleMstrList');
    Route::get('/RoleMstrList/data', [RoleController::class, 'data'])->name('RoleMstr.data');
    Route::get('RoleMstr/{roleId}/delete', [RoleController::class, 'destroy']);
    Route::get('RoleMstr/{roleId}/give-permission', [RoleController::class, 'addPermissionToRole']);
    Route::put('RoleMstr/{roleId}/give-permission', [RoleController::class, 'givePermissionToRole']);

    // permission mstr
    Route::resource('PermissionMstrs', PermissionController::class);
    Route::get('PermissionMstrList', [PermissionController::class, 'index'])->name('PermissionMstrList');
    Route::get('/PermissionMstrList/data', [PermissionController::class, 'data'])->name('PermissionMstr.data');
    Route::get('PermissionMstr/{permissionId}/delete', [PermissionController::class, 'destroy']);

    // User Master
    Route::resource('UserMstrs', UserController::class);
    Route::get('/UserMstrList', [UserController::class, 'index'])->name('UserMstrList');
    Route::get('/UserMstrList/data', [UserController::class, 'data'])->name('UserMstr.data');
    Route::get('UserMstr/{userId}/delete', [UserController::class, 'destroy']);
});

require __DIR__ . '/auth.php';

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

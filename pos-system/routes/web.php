<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\MemberController;


use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/items', [InventoryController::class, 'index'])->name('items.index');
    Route::post('/item', [InventoryController::class, 'store']);
    Route::delete('/item/{item}', [InventoryController::class, 'destroy']);
    Route::get('/item/edit/{item}', [InventoryController::class, 'edit'])->name('item.edit');
    Route::put('/item/edit/{item}', [InventoryController::class, 'saveEdit'])->name('item.saveEdit');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::post('/member', [MemberController::class, 'store'])->name('member.store');
    Route::delete('/member/{member}', [MemberController::class, 'destroy'])->name('member.destroy');
    Route::get('/member/edit/{member}', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/edit/{member}', [MemberController::class, 'saveEdit'])->name('member.saveEdit');

    Route::get('/sale', function () {
        return view('sale.newSale');
    })->name('newSale');

    Route::get('/sale/open', [RegisterController::class, 'openNewSale'])->name('openNewSale');
    Route::post('/sale/sale_line_item/add', [RegisterController::class, 'addSaleLineItem'])->name('addSaleLineItem');
    Route::delete('/sale/sale_line_item/remove', [RegisterController::class, 'removeSaleLineItem'])->name('removeSaleLineItem');
    Route::post('/sale/member/add', [RegisterController::class, 'addMember'])->name('addMember');
    Route::post('/sale/payment', [RegisterController::class, 'processPayment'])->name('processPayment');

    Route::get('/sales', [RegisterController::class, 'index'])->name('sales.index');
    Route::delete('/sale/{sale}', [RegisterController::class, 'destroy'])->name('sale.destroy');


    Route::get('/session', [RegisterController::class, 'viewSession'])->name('viewSession');
    Route::get('/clear', [RegisterController::class, 'clearSession'])->name('clearSession');

});
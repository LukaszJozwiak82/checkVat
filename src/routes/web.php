<?php

use Illuminate\Support\Facades\Route;
use Vat\Vat\Http\Controllers\VatController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/vat/{nip}', [VatController::class, 'checkVat'])->name('vat.checkVat');
});

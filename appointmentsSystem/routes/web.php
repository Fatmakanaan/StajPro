<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::middleware(['auth'])->group(function() {
    Route::get('/appointments', [AppointmentController::class,'index'])->name('user.appointments.index');
    Route::get('/appointments/create', [AppointmentController::class,'create'])->name('user.appointments.create');
    Route::post('/appointments', [AppointmentController::class,'store'])->name('user.appointments.store');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class,'edit'])->name('user.appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class,'update'])->name('user.appointments.update');
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class,'cancel'])->name('user.appointments.cancel');

    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/appointments', [AppointmentController::class,'adminIndex'])->name('admin.appointments.index');
        Route::get('/appointments/create', [AppointmentController::class,'adminCreate'])->name('admin.appointments.create');
        Route::post('/appointments', [AppointmentController::class,'adminStore'])->name('admin.appointments.store');
        Route::get('/appointments/{appointment}/edit', [AppointmentController::class,'adminEdit'])->name('admin.appointments.edit');
        Route::put('/appointments/{appointment}', [AppointmentController::class,'adminUpdate'])->name('admin.appointments.update');
        Route::delete('/appointments/{appointment}', [AppointmentController::class,'destroy'])->name('admin.appointments.destroy');
    });
});

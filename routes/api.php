<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notes\NoteController;
use App\Http\Controllers\Notes\SubjectController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Notes')->group(function (){
    Route::prefix('notes')->group(function (){
        Route::post('create-new-note', [NoteController::class, 'store']);
        Route::get('', [NoteController::class, 'index']);
        Route::get('{note:slug}', [NoteController::class, 'show'])->name('note.show');
    });

    Route::prefix('subjects')->group(function (){
        Route::get('', [SubjectController::class, 'index']);
    });
});

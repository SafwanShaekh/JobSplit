<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

// Employer side
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
// Employer ko form dikhana jahan wo new job post karega.

Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
// Employer form fill karke submit kare → ye route data ko database me save karega.

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
// Job ko edit karne ka form.

Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
// Job edit karne ke baad update karna.

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
// Job ko delete karna.

// Worker side
Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');
// Worker ko sare available jobs ka listing page dikhana.

Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
// Ek single job ka detail page dikhana.
// {job} → automatically Job model se record fetch hoga (Laravel ka feature: Route Model Binding).

// Employer My Jobs
Route::get('/my-jobs', [JobController::class, 'index'])->name('jobs.index');
// Employer apni post ki hui jobs dekh sakega

//VIEW DETAILS WALE PAGE PR LA JAYEGA
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/', function () {
    return view('welcome');
});

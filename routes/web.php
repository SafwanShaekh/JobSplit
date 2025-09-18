<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobApplicantsController;
use App\Http\Controllers\FeedbackController; 
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- GUEST ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// --- PUBLIC ROUTES ---
Route::get('/', function () {
    return view('home');
})->name('home');

// Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Browse Jobs ka page filhal auth ma rakh raha hon uper sa comment kar dia hai
    Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');

    // Employer My Jobs
    Route::get('/my-jobs', [JobController::class, 'index'])->name('jobs.index');

    // Job Management (Specific routes first)
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');

    // Job View Route (Private)
    Route::get('jobs/show', [JobController::class, 'show'])->name('jobs.show');

    // Wildcard routes for edit/update/delete come after create/store
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

     // jobs pa apply karny ka Routes
    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('jobs.apply.create');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply.store');

     // Job Applicants Routes
    Route::get('/job-applicants', [JobApplicantsController::class, 'index'])->name('job-applicants.index');
    Route::get('/job-applicants/{job}', [JobApplicantsController::class, 'show'])->name('job-applicants.show');
    Route::post('/job-applicants/{job}/approve/{application}', [JobApplicantsController::class, 'approve'])->name('job-applicants.approve');
    
    // Applied Jobs ka Route
    Route::get('/applied-jobs', [ApplicationController::class, 'index'])
     ->middleware('auth') // Sirf logged-in user is page ko dekh sakta hai
     ->name('applications.index'); // Is route ko ek naam de dein

    // Feedback Route
     Route::post('/feedback/{application}', [FeedbackController::class, 'store'])
     ->middleware('auth')
     ->name('feedback.store');  
    
     // Add this line in routes/web.php
    Route::get('/dashboard/chart-data', [App\Http\Controllers\DashboardController::class, 'getChartData'])->middleware('auth')->name('dashboard.chart');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// --- PUBLIC WILDCARD ROUTE (MUST BE LAST) ---
// This route is placed last to avoid conflicts with routes like '/jobs/create'
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');


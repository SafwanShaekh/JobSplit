<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Ise add karein

// --- WEBSITE CONTROLLERS ---
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobApplicantsController;
use App\Http\Controllers\FeedbackController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplaintController as WebsiteComplaintController; // Naya Website Complaint Controller

// --- ADMIN PANEL CONTROLLERS (Naye Pata Ke Sath) ---
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Middleware\AdminAuthenticate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ##########################################
// ### WEBSITE ROUTES ###
// ##########################################

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

// --- AUTHENTICATED ROUTES ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Jobs Routes...
    Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');
    Route::get('/my-jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('jobs.apply.create');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply.store');
    Route::get('/job-applicants', [JobApplicantsController::class, 'index'])->name('job-applicants.index');
    Route::get('/job-applicants/{job}', [JobApplicantsController::class, 'show'])->name('job-applicants.show');
    Route::post('/job-applicants/{job}/approve/{application}', [JobApplicantsController::class, 'approve'])->name('job-applicants.approve');
    Route::get('/applied-jobs', [ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/feedback/{application}', [FeedbackController::class, 'store'])->name('feedback.store'); 
    Route::get('/dashboard/chart-data', [App\Http\Controllers\DashboardController::class, 'getChartData'])->name('dashboard.chart');

    // === YAHAN NAYA CODE ADD KIYA GAYA HAI ===
    // User Complaints Routes
    Route::get('/my-complaints', [WebsiteComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [WebsiteComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [WebsiteComplaintController::class, 'store'])->name('complaints.store');

    // Notification Route
    Route::get('/notifications/mark-as-read', function() {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->noContent();
    })->name('notifications.markAsRead');
    // === END NEW CODE ===

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// --- PUBLIC WILDCARD ROUTE (MUST BE LAST) ---
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');


// ####################################
// ### ADMIN PANEL ROUTES ###
// ####################################

// Admin login routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});

// Authenticated admin routes
Route::middleware([AdminAuthenticate::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserManagementController::class)->only(['index', 'destroy']);
    Route::post('/users/{user}/toggle-ban', [UserManagementController::class, 'toggleBan'])->name('users.toggle-ban');
    Route::resource('jobs', AdminJobController::class);
    Route::resource('complaints', ComplaintController::class)->only(['index']);
    Route::post('/complaints/{complaint}/resolve', [ComplaintController::class, 'resolve'])->name('complaints.resolve');
    Route::get('/complaints/count', [ComplaintController::class, 'count']);
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/download', [AdminReportController::class, 'download'])->name('reports.download');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
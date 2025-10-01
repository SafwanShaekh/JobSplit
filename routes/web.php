<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Ise add karein
// --- WEBSITE CONTROLLERS ---
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobApplicantsController;
use App\Http\Controllers\FeedbackController; 
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplaintController as WebsiteComplaintController; // Naya Website Complaint Controller
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController; 
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


// --- ADMIN PANEL CONTROLLERS (Naye Pata Ke Sath) ---
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Middleware\PreventBackHistory; // PreventBackHistory middleware ko import karein


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
        // Forgot Password Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');    
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');
    // Reset Password Routes
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});


Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// --- PUBLIC ROUTES ---
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact_us', function () {
    return view('contact_us');
})->name('contact_us');

Route::get('/jobs', [JobController::class, 'browse'])->name('jobs.browse');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');

Route::get('/logout', [LoginController::class, 'handleGetLogout'])->name('logout.get');


// --- AUTHENTICATED ROUTES ---
Route::middleware(['auth',PreventBackHistory::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    
    // Jobs Routes...

    Route::get('/my-jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::patch('/my-jobs/{job}/status', [JobController::class, 'updateStatus'])->name('jobs.updateStatus');
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
    
        // Yeh route Chat button par lagega
    Route::get('/chat/with/{user}', [ChatController::class, 'startConversation'])->name('chat.with')->middleware('auth');

    Route::get('/chat', function () {
        return view('chat.index'); // Ab yeh hamari nayi view file ko load karega
    })->name('chat')->middleware('auth');

    // User Complaints Routes
    Route::get('/my-complaints', [WebsiteComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [WebsiteComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [WebsiteComplaintController::class, 'store'])->name('complaints.store');

    // Notifications Routes
    Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])
     ->middleware('auth')
     ->name('notifications.markAsRead');

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // Route::get('/logout', [LoginController::class, 'logout'])->name('login.get'); // GET request ke liye bhi route
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

Route::get('/logout', [AdminAuthController::class, 'handleGetLogout'])->name('logout.get');

// Authenticated admin routes
Route::middleware([AdminAuthenticate::class , PreventBackHistory::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserManagementController::class)->only(['index', 'destroy']);
    Route::post('/users/{user}/toggle-ban', [UserManagementController::class, 'toggleBan'])->name('users.toggle-ban');
    Route::resource('jobs', AdminJobController::class);
    Route::resource('complaints', ComplaintController::class)->only(['index']);
    Route::post('/complaints/{complaint}/in-progress', [ComplaintController::class, 'markAsInProgress'])->name('complaints.in-progress');
    Route::post('/complaints/{complaint}/resolve', [ComplaintController::class, 'resolve'])->name('complaints.resolve');
    Route::get('/complaints/count', [ComplaintController::class, 'count']);
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/contact-details', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/count', [ContactController::class, 'countUnread'])->name('contact.count');
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/download', [AdminReportController::class, 'download'])->name('reports.download');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    
});
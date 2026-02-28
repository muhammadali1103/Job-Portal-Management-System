<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

Route::get('/', function () {
    $jobs = \App\Models\Job::where('status', 'approved')
        ->with(['category', 'location', 'user'])
        ->latest()
        ->paginate(15);

    $locations = \App\Models\Location::orderBy('city')->get();
    $categories = \App\Models\Category::orderBy('name')->get();

    // For popular roles, we want roles that actually have jobs or are common
    $usedRoles = \App\Models\Job::where('status', 'approved')
        ->whereNotNull('job_role')
        ->distinct()
        ->pluck('job_role')
        ->toArray();

    $jobRoles = \App\Models\JobRole::whereIn('name', $usedRoles)
        ->orderBy('name')
        ->get();

    return view('welcome', compact('jobs', 'jobRoles', 'locations', 'categories'));
})->name('home');

// Legal Pages
Route::view('/about', 'pages.about')->name('about');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::view('/categories', 'categories.index')->name('categories.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

// Sitemap
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Job Application (No auth required - guests can apply)
Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
Route::get('/jobs/{job}/track-apply', [App\Http\Controllers\JobTrackingController::class, 'trackClick'])->name('jobs.trackApply');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job Application
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('applications.index');

    // Employer Job Management  
    Route::prefix('employer')->name('employer.')->group(function () {
        Route::get('/jobs/create', [App\Http\Controllers\Employer\JobManagementController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [App\Http\Controllers\Employer\JobManagementController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}/edit', [App\Http\Controllers\Employer\JobManagementController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [App\Http\Controllers\Employer\JobManagementController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [App\Http\Controllers\Employer\JobManagementController::class, 'destroy'])->name('jobs.destroy');
    });

    // User Job Management (same as employer, different route names)
    Route::prefix('user/jobs')->name('user.jobs.')->group(function () {
        Route::get('/', [App\Http\Controllers\Employer\JobManagementController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Employer\JobManagementController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Employer\JobManagementController::class, 'store'])->name('store');
        Route::get('/{job}/edit', [App\Http\Controllers\Employer\JobManagementController::class, 'edit'])->name('edit');
        Route::put('/{job}', [App\Http\Controllers\Employer\JobManagementController::class, 'update'])->name('update');
        Route::delete('/{job}', [App\Http\Controllers\Employer\JobManagementController::class, 'destroy'])->name('destroy');
    });

    // Admin Dashboard & Management
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');

        // Jobs
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/create', [AdminJobController::class, 'create'])->name('jobs.create'); // Add Create Route
        Route::post('/jobs', [AdminJobController::class, 'store'])->name('jobs.store'); // Add Store Route
        Route::get('/jobs/{job}', [AdminJobController::class, 'show'])->name('jobs.show');
        Route::get('/jobs/{job}/edit', [AdminJobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [AdminJobController::class, 'update'])->name('jobs.update');
        Route::post('/jobs/approve-all', [AdminJobController::class, 'approveAll'])->name('jobs.approveAll');
        Route::post('/jobs/toggle-auto-approve', [AdminJobController::class, 'toggleAutoApproval'])->name('jobs.toggleAutoApprove');
        Route::patch('/jobs/{job}/approve', [AdminJobController::class, 'approve'])->name('jobs.approve');
        Route::patch('/jobs/{job}/reject', [AdminJobController::class, 'reject'])->name('jobs.reject');
        Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');

        // Job Roles
        Route::resource('job-roles', App\Http\Controllers\Admin\JobRoleController::class)->except(['create', 'show', 'edit']);

        // Categories
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

        // Locations
        Route::get('/locations', [App\Http\Controllers\Admin\LocationController::class, 'index'])->name('locations.index');
        Route::post('/locations', [App\Http\Controllers\Admin\LocationController::class, 'store'])->name('locations.store');
        Route::put('/locations/{location}', [App\Http\Controllers\Admin\LocationController::class, 'update'])->name('locations.update');
        Route::delete('/locations/{location}', [App\Http\Controllers\Admin\LocationController::class, 'destroy'])->name('locations.destroy');

        // Users
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // Profile
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('password.update');
    });
});


require __DIR__ . '/auth.php';

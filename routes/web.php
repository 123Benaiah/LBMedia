<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect '/' to login page if not authenticated
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Prevent logged-in users from accessing login/register pages
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// Protect dashboard and media routes (only accessible after login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        // Count media files for charts
        $audioCount = Media::where('type', 'audio')->count();
        $videoCount = Media::where('type', 'video')->count();
        $imageCount = Media::where('type', 'image')->count();

        // Recent media uploads
        $twelveHoursAgo   = Carbon::now()->subHours(12);
        $recentAudioCount = Media::where('type', 'audio')->where('created_at', '>=', $twelveHoursAgo)->count();
        $recentVideoCount = Media::where('type', 'video')->where('created_at', '>=', $twelveHoursAgo)->count();
        $recentImageCount = Media::where('type', 'image')->where('created_at', '>=', $twelveHoursAgo)->count();

        // Data for charts
        $donutChartLabels = ['Audio', 'Video', 'Image'];
        $donutChartData   = [$recentAudioCount, $recentVideoCount, $recentImageCount];

        $pieChartLabels = ['Audio', 'Video', 'Image'];
        $pieChartData   = [$audioCount, $videoCount, $imageCount];

        return view('dashboard', compact(
            'audioCount', 'videoCount', 'imageCount',
            'donutChartLabels', 'donutChartData',
            'pieChartLabels', 'pieChartData'
        ));
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    // Media and categories routes
    Route::resource('media', MediaController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/media_audio', [MediaController::class, 'audio'])->name('media_audio');
    Route::get('/media_video', [MediaController::class, 'video'])->name('media_video');
    Route::get('/media_image', [MediaController::class, 'image'])->name('media_image');

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login')->with('status', 'Logged out successfully.');
    })->name('logout');
});

// Authentication Routes
Auth::routes();

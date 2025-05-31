<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('web')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->role === 'konselor') {
            return redirect()->route('konselor.dashboard');
        }

        abort(403);
    })->middleware(['auth', 'verified'])->name('dashboard');
});
    }
}

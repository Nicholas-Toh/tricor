<?php

use App\Enum\SalesReportView;
use App\Enum\UserRole;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\SalesTransactionController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('', function (Request $request) {
        switch ($request->user()->role) {
            case UserRole::Manager:
                return Inertia::render('ManagerDashboard', [
                    'views' => SalesReportView::cases(),
                    'viewLabels' => config('labels.sales_report_view_labels'),
                    'agents' => $request->user()->marketing_agents
                ]);
            case UserRole::MarketingAgent:
                return Inertia::render('MarketingAgentDashboard', [
                    'salesTransactions' => $request->user()->sales_transactions()->limit(20)->latest()->get(),
                ]);
            default:
                return Inertia::render('Dashboard');
        }
    })->name('dashboard');

    Route::get('/reports', [SalesReportController::class, 'index'])->name('sales-reports');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::prefix('sales-transactions')->controller(SalesTransactionController::class)->group(function () {
        Route::get('', 'index')->name('api.sales-transaction');
        Route::post('', 'store')->name('api.sales-transaction.store');
    });

    // Route::prefix('sales-reports')->controller(SalesReportController::class)->group(function () {
    //     Route::get('', 'index')->name('sales-report');
    //     Route::post('', 'store')->name('sales-report.store');
    // });
});

require __DIR__.'/auth.php';

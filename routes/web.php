<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    UserController,
    DepositController,
    WalletController,
    InvestmentController,
    WithdrawalController,
    ForgotPasswordController,
    ResetPasswordController,
    ReferralController
};
use App\Http\Controllers\Admin\{
    AdminController,
    AdminAuthController,
    PlanController,
    WithdrawalSettingController,
    SettingController
};

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('frontend.home'))->name('home');
Route::get('/about', fn() => view('frontend.about'))->name('about');
Route::get('/contact', fn() => view('frontend.contact'))->name('contact');
Route::get('/faq', fn() => view('frontend.faq'))->name('faq');
Route::get('/offer', fn() => view('frontend.offer'))->name('offer');
Route::get('/policy', fn() => view('frontend.policy'))->name('policy');
Route::get('/term', fn() => view('frontend.term'))->name('term');

/*
|--------------------------------------------------------------------------
| USER AUTH & DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('user')->name('user.')->group(function () {

    // 🔒 Guest Routes
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

        // Forgot Password Form
        Route::get('password/request', [ForgotPasswordController::class, 'showLinkRequestForm'])
            ->name('password.request');

        // Send reset email
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
            ->name('password.email');

        // Reset password form (required route name)
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
            ->name('password.reset');

        // Handle reset password
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])
            ->name('password.update');

    });

    // 🔐 Authenticated User Routes
    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        // Profile
        Route::get('/profile', [UserController::class, 'editProfile'])->name('profile');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/change-password', [UserController::class, 'userChangePassword'])->name('profile.change-password');

        // KYC Routes
        Route::get('/kyc', [UserController::class, 'showKyc'])->name('kyc.form');
        Route::post('/kyc', [UserController::class, 'submitKyc'])->name('kyc');

        // Referrals
        Route::get('/referrals', [ReferralController::class, 'index'])->name('referrals.index');

        // Deposits
        Route::get('/deposit', [DepositController::class, 'create'])->name('deposit.create');
        Route::post('/deposit', [DepositController::class, 'store'])->name('deposit.store');
        Route::get('/deposits', [DepositController::class, 'depositHistory'])->name('history.deposits');

        // Investments / Plans
        Route::prefix('plans')->name('plans.')->group(function () {
            Route::get('/', [InvestmentController::class, 'index'])->name('index');
            Route::get('/active', [InvestmentController::class, 'active'])->name('active');
            Route::get('/create', [InvestmentController::class, 'create'])->name('create');
            Route::post('/', [InvestmentController::class, 'store'])->name('store');
            Route::get('/{investment}', [InvestmentController::class, 'show'])->name('show');
            Route::patch('/{investment}/cancel', [InvestmentController::class, 'cancel'])->name('cancel');
            Route::get('//live', [PlanController::class, 'live'])->name('live')->middleware('auth');
        });

        // Withdrawals
        Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
            Route::get('/', [WithdrawalController::class, 'index'])->name('index');
            Route::post('/', [WithdrawalController::class, 'store'])->name('store');
            Route::get('/withdrawals', [WithdrawalController::class, 'withdrawalHistory'])->name('history');
        });
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH & DASHBOARD
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // 🔒 Guest Admin Routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    });

    // ⚙️ App Settings
    Route::prefix('/app')->name('app.')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    });

    // 🔐 Authenticated Admin Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Profile
        Route::get('/profile', [AdminAuthController::class, 'showProfile'])->name('profile');
        Route::put('/profile/update', [AdminAuthController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile/change-password', [AdminAuthController::class, 'changePassword'])->name('profile.change-password');

        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::post('/{user}/block', [UserController::class, 'block'])->name('block');
            Route::post('/{user}/unblock', [UserController::class, 'unblock'])->name('unblock');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-action', [UserController::class, 'bulkAction'])->name('bulk-action');
            Route::post('/{user}/adjust-balance', [UserController::class, 'adjustBalance'])->name('adjust-balance');
            Route::get('/{user}/login-as', [UserController::class, 'loginAsUser'])->name('login-as');
            Route::post('/{user}/send-email', [UserController::class, 'sendEmail'])->name('send-email');
            Route::post('/{user}/change-password', [UserController::class, 'changePassword'])->name('change-password');
        });


        // Admin KYC Management
        Route::prefix('kyc')->name('kyc.')->group(function () {
            // List all KYC requests
            Route::get('', [AdminController::class, 'kycIndex'])->name('index');

            // View individual KYC details
            Route::get('/{user}', [AdminController::class, 'kycShow'])->name('show');

            // Individual KYC actions (use POST to avoid PATCH issues)
            Route::post('/{user}/approve', [AdminController::class, 'approveKyc'])->name('approve');
            Route::post('/{user}/reject', [AdminController::class, 'rejectKyc'])->name('reject');

            // Bulk KYC actions
            Route::post('/bulk', [AdminController::class, 'bulkKycAction'])->name('bulk');
        });



        // Wallets
        Route::prefix('wallets')->name('wallets.')->group(function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('/create', [WalletController::class, 'create'])->name('create');
            Route::post('/', [WalletController::class, 'store'])->name('store');
            Route::get('/{wallet}/edit', [WalletController::class, 'edit'])->name('edit');
            Route::put('/{wallet}', [WalletController::class, 'update'])->name('update');
            Route::delete('/{wallet}', [WalletController::class, 'destroy'])->name('destroy');
        });

        // Deposits
        Route::prefix('deposits')->name('deposits.')->group(function () {
            Route::get('/', [AdminController::class, 'deposits'])->name('index');
            Route::get('/pending', [AdminController::class, 'pendingDeposits'])->name('pending');
            Route::patch('/{deposit}/approve', [AdminController::class, 'approveDeposit'])->name('approve');
            Route::patch('/{deposit}/reject', [AdminController::class, 'rejectDeposit'])->name('reject');
            Route::get('/live', [DepositController::class, 'live'])->name('live');
        });

        // Plans
        Route::prefix('plans')->name('plans.')->group(function () {
            Route::get('/', [PlanController::class, 'index'])->name('index');
            Route::get('/create', [PlanController::class, 'create'])->name('create');
            Route::post('/', [PlanController::class, 'store'])->name('store');
            Route::get('/{plan}/edit', [PlanController::class, 'edit'])->name('edit');
            Route::patch('/{plan}', [PlanController::class, 'update'])->name('update');
            Route::delete('/{plan}', [PlanController::class, 'destroy'])->name('destroy');
        });

        // Withdrawals
        Route::prefix('withdrawals')->name('withdrawals.')->group(function () {
            Route::get('/', [WithdrawalController::class, 'adminIndex'])->name('index');
            Route::get('/pending', [WithdrawalController::class, 'pending'])->name('pending');
            Route::get('/approved', [WithdrawalController::class, 'approved'])->name('approved');
            Route::get('/rejected', [WithdrawalController::class, 'rejected'])->name('rejected');
            Route::post('/{id}/update', [WithdrawalController::class, 'updateStatus'])->name('update');
        });

        // Withdrawal Settings
    Route::prefix('withdrawal-settings')->name('withdrawal-settings.')->group(function () {
    Route::get('/', [WithdrawalSettingController::class, 'index'])->name('index');

    // Update settings (PUT request)
    Route::put('/update', [WithdrawalSettingController::class, 'update'])->name('update');
});

    });
});

/*
|--------------------------------------------------------------------------
| LOGIN FALLBACK
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return request()->is('admin*')
        ? redirect()->route('admin.login')
        : redirect()->route('user.login');
})->name('login');

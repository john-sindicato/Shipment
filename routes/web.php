<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminLogoutController;
use App\Http\Controllers\Admin\Company\BranchController;
use App\Http\Controllers\Admin\Company\CompanyController;
use App\Http\Controllers\Admin\Rates\RatesController;
use App\Http\Controllers\Admin\Rates\CategoryController;
use App\Http\Controllers\Admin\Rates\WeightLimitController;
use App\Http\Controllers\Admin\Accounts\UserController;
use App\Http\Controllers\Admin\Accounts\TellerController;
use App\Http\Controllers\Action\ContactUsController;
use App\Http\Controllers\Action\RequestController;
use App\Http\Controllers\Teller\TellerPageController;
use App\Http\Controllers\Teller\Auth\TellerLoginController;
use App\Http\Controllers\Teller\Auth\TellerLogoutController;
use App\Http\Controllers\Action\Submitted_RequestController;
use App\Http\Controllers\Action\Declined_RequestController;
use App\Http\Controllers\Action\Approved_RequestController;
use App\Http\Controllers\Action\QueuedController;
use App\Http\Controllers\Action\CancelledController;
use App\Http\Controllers\Action\InTransitShipmentController;
use App\Http\Controllers\Action\ClaimedController;
use App\Http\Controllers\Action\UnclaimController;
use App\Http\Controllers\Action\DispatchController;
use App\Http\Controllers\Action\DashboardController;
use App\Http\Controllers\Customer\NotificationController;
use App\Http\Controllers\Customer\ClaimStubController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\AuthenticateUser;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\TellerAuthMiddleware;

Route::middleware([AuthenticateUser::class])->group(function () {
    Route::get('/customer/pages/home', function () {
        return view('home');
    })->name('home');

    Route::get('/customer/pages/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('customer/pages/routes', [RatesController::class, 'route'])->name('routes');
    Route::get('customer/pages/shipment_dashboard', [PageController::class, 'shipmentDashboard'])->name('customer.pages.shipment_dashboard');    
    Route::get('customer/layout/layout', [PageController::class, 'layout'])->name('layout');

    Route::get('customer/pages/request_form', [PageController::class, ('request_form')])->name('request_form');
    Route::get('customer/pages/home', [PageController::class, ('home')])->name('home');

    Route::get('customer/pages/shipment_dashboard', [RequestController::class, 'badge'])->name('customer.pages.shipment_dashboard');
    Route::get('/shipment-counts', [RequestController::class, 'getShipmentCounts']);

    Route::get('customer/pages/shipment/pending', [PageController::class, 'pending'])->name('customer.pages.shipment.pending');
    Route::get('customer/pages/shipment/pending', [RequestController::class, 'index_user'])->name('customer.pages.shipment.pending');
    Route::get('/customer/pages/shipment/details/pending/{id}', [RequestController::class, 'show_user'])->name('customer.pages.shipment.details.pending');
    
    Route::get('customer/pages/shipment/approved', [PageController::class, 'approved'])->name('customer.pages.shipment.approved');
    Route::get('customer/pages/shipment/approved', [Approved_RequestController::class, 'index_user'])->name('customer.pages.shipment.approved');
    Route::get('/customer/pages/shipment/details/approved/{id}', [Approved_RequestController::class, 'show_user'])->name('customer.pages.shipment.details.approved');
    
    Route::get('customer/pages/shipment/queued', [PageController::class, 'queued'])->name('customer.pages.shipment.queued');
    Route::get('customer/pages/shipment/queued', [QueuedController::class, 'index_user'])->name('customer.pages.shipment.queued');
    Route::get('/customer/pages/shipment/details/queued/{id}', [QueuedController::class, 'show_user'])->name('customer.pages.shipment.details.queued');
    
    Route::get('customer/pages/shipment/in_transit', [PageController::class, 'in_transit'])->name('customer.pages.shipment.in_transit');
    Route::get('customer/pages/shipment/in_transit', [InTransitShipmentController::class, 'index_user'])->name('customer.pages.shipment.in_transit');
    Route::get('/customer/pages/shipment/details/in_transit/{id}', [InTransitShipmentController::class, 'show_user'])->name('customer.pages.shipment.details.in_transit');
    
    Route::get('customer/pages/shipment/dispatched', [PageController::class, 'dispatched'])->name('customer.pages.shipment.dispatched');
    Route::get('customer/pages/shipment/dispatched', [DispatchController::class, 'index_user'])->name('customer.pages.shipment.dispatched');
    Route::get('/customer/pages/shipment/details/dispatched/{id}', [DispatchController::class, 'show_user'])->name('customer.pages.shipment.details.dispatched');
    
    Route::get('customer/pages/shipment/cancelled', [PageController::class, 'cancelled'])->name('customer.pages.shipment.cancelled');
    Route::get('customer/pages/shipment/cancelled', [CancelledController::class, 'index_user'])->name('customer.pages.shipment.cancelled');
    Route::get('/customer/pages/shipment/details/cancelled/{id}', [CancelledController::class, 'show_user'])->name('customer.pages.shipment.details.cancelled');
    
    Route::get('customer/pages/shipment/claimed', [PageController::class, 'claimed'])->name('customer.pages.shipment.claimed');
    Route::get('customer/pages/shipment/claimed', [ClaimedController::class, 'index_claim_user'])->name('customer.pages.shipment.claimed');
    Route::get('/customer/pages/shipment/details/claimed/{id}', [ClaimedController::class, 'show_claim_user'])->name('customer.pages.shipment.details.claimed');
   
    Route::get('customer/pages/shipment/unclaim', [PageController::class, 'unclaim'])->name('customer.pages.shipment.unclaim');
    Route::get('customer/pages/shipment/unclaim', [UnclaimController::class, 'index_unclaim_user'])->name('customer.pages.shipment.unclaim');
    Route::get('/customer/pages/shipment/details/unclaim/{id}', [UnclaimController::class, 'show_unclaim_user'])->name('customer.pages.shipment.details.unclaim');
    
    Route::middleware(['auth'])->get('/notifications', [NotificationController::class, 'getNotifications']);
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/remove-all', [NotificationController::class, 'removeAllNotifications']);

    Route::middleware(['auth'])->get('/claim-stubs', [ClaimStubController::class, 'getClaimStubs']);
    Route::post('/claim-stubs/mark-as-read', [ClaimStubController::class, 'markAsRead']);
    Route::post('/claimstubs/remove-all', [ClaimStubController::class, 'removeAllClaimStub']);
    Route::get('/claim-stubs/{shipment_id}', [ClaimStubController::class, 'show']);

});

Route::get('customer/auth/verify-otp', [RegisterController::class, 'showVerificationForm'])->name('verify-otp');

// Verification routes
Route::get('/email/verify', [RegisterController::class, 'showVerificationForm'])
    ->name('verification.notice');

Route::post('/email/verify', [RegisterController::class, 'verifyOtp'])
    ->name('verification.verify');

Route::post('/email/resend', [RegisterController::class, 'resendOtp'])
    ->name('verification.resend');

    // Verification routes
Route::get('/email/verify', [RegisterController::class, 'showVerificationForm'])
->name('verification.notice');

Route::post('/email/verify', [RegisterController::class, 'verifyOtp'])
->name('verification.verify');

Route::post('/email/resend', [RegisterController::class, 'resendOtp'])
->name('verification.resend');

Route::get('/email/change', [RegisterController::class, 'showChangeEmailForm'])
->name('verification.change-email');

Route::post('/email/change', [RegisterController::class, 'changeEmail'])
->name('verification.update-email');

// Password reset routes
Route::get('customer/auth/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('customer.auth.forgot-password');
// Password reset routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetOtp'])
    ->name('password.email');

Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyForm'])
    ->name('password.verify');

Route::post('/verify-otp-password', [ForgotPasswordController::class, 'verifyOtp'])
    ->name('password.verify.submit');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])
    ->name('password.update');

Route::post('/resend-otp', [ForgotPasswordController::class, 'resendOtp'])
    ->middleware('throttle:3,1')  
    ->name('password.resend');

Route::middleware([TellerAuthMiddleware::class])->group(function () {
    Route::get('teller/pages/dashboard', [TellerPageController::class, 'dashboard'])->name('teller.pages.dashboard');
    Route::get('teller/pages/request', [TellerPageController::class, 'request'])->name('teller.pages.request');
    Route::get('teller/pages/change_password', [TellerPageController::class, 'change_Password'])->name('change_password');
    Route::get('teller/pages/profile', [TellerPageController::class, 'profile'])->name('teller.pages.profile');
    Route::get('teller/pages/request', [RequestController::class, 'index'])->name('teller.pages.request');
    Route::get('teller/pages/declined', [TellerPageController::class, 'declined'])->name('teller.pages.declined');
    Route::get('teller/pages/approved', [TellerPageController::class, 'approved'])->name('teller.pages.approved');
    Route::get('teller/pages/queued', [TellerPageController::class, 'queued'])->name('teller.pages.queued');
    Route::get('teller/pages/in_transit', [TellerPageController::class, 'inTransit'])->name('teller.pages.in_transit');
    Route::get('teller/pages/dispatched', [TellerPageController::class, 'dispatched'])->name('teller.pages.dispatched');
    Route::get('teller/pages/claimed', [TellerPageController::class, 'claimed'])->name('teller.pages.claimed');
    Route::get('teller/pages/unclaimed', [TellerPageController::class, 'unclaimed'])->name('teller.pages.unclaimed');

    Route::get('/messages', [ContactUsController::class, 'getMessages']);
    Route::post('/messages/mark-as-read', [ContactUsController::class, 'markAsRead1']);
    Route::post('/messages/remove-all', [ContactUsController::class, 'removeAllMessages']);

    Route::get('/message/{id}', [ContactUsController::class, 'getMessage']);

    Route::post('/send-reply', [ContactUsController::class, 'sendReply']);

    Route::get('teller/pages/dashboard', [DashboardController::class, 'badge'])->name('teller.pages.dashboard');
});

Route::get('/teller/pages/details/request/{id}', [RequestController::class, 'show'])->name('teller.pages.details.request');
Route::get('teller/login', [TellerPageController::class, 'login'])->name('teller.login');

Route::post('teller/login', [TellerLoginController::class, 'login_teller'])->name('teller_login');
Route::post('/teller/logout', [TellerLogoutController::class, 'logout'])->name('teller.logout');

  
Route::get('/', [PageController::class, 'showRatesindex']);  
Route::get('customer/index', [PageController::class, 'showRatesindex'])->name('index');

Route::get('customer/index', [PageController::class, ('showRatesindex')])->name('index');
Route::get('customer/auth/sign_up', [PageController::class, ('sign_up')])->name('sign_up');
Route::get('customer/auth/login', [PageController::class, ('login')])->name('login');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('customer/auth/sign_up', [RegisterController::class, 'store'])->name('sign_up.store');
Route::post('customer/auth/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('admin/login', [AdminPageController::class, 'showLoginForm'])->name('admin.login');

Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin_login');
Route::post('/admin/logout', [AdminLogoutController::class, 'logout'])->name('admin_logout');

Route::middleware([AdminAuthMiddleware::class])->group(function () {
    Route::get('/admin/pages/dashboard', function () {
        return view('admin.pages.dashboard');
    })->name('admin.pages.dashboard');

    Route::get('admin/pages/dashboard', [AdminPageController::class, 'dashboard'])->name('admin.pages.dashboard');
    Route::get('admin/pages/accounts/teller', [AdminPageController::class, 'teller'])->name('admin.pages.accounts.teller');
    Route::get('admin/pages/request', [AdminPageController::class, 'request'])->name('admin.pages.request');
    Route::get('admin/layout/layout', [AdminPageController::class, 'layout'])->name('admin.layout.layout');
    Route::get('admin/pages/company/branch', [AdminPageController::class, 'branch'])->name('admin.pages.company.branch');
    Route::get('admin/pages/rates/rates', [AdminPageController::class, 'rates'])->name('admin.pages.rates.rates');
    Route::get('admin/pages/rates/categories', [AdminPageController::class, 'categories'])->name('admin.pages.rates.categories');
    Route::get('admin/pages/accounts/user', [AdminPageController::class, 'user'])->name('admin.pages.accounts.user');
    Route::get('admin/pages/company/contact_details', [AdminPageController::class, 'company'])->name('admin.pages.company.contact_details');   
    Route::get('admin/pages/shipments/submitted_request', [AdminPageController::class, 'submitted_request'])->name('admin.pages.shipments.submitted_request'); 
    Route::get('admin/pages/shipments/queued', [AdminPageController::class, 'queued'])->name('admin.pages.shipments.queued');
    Route::get('admin/pages/shipments/cancelled', [AdminPageController::class, 'cancelled'])->name('admin.pages.shipments.cancelled');
    Route::get('admin/pages/shipments/dispatched', [AdminPageController::class, 'dispatched'])->name('admin.pages.shipments.dispatched');
    Route::get('admin/pages/dashboard', [DashboardController::class, 'badge_admin'])->name('admin.pages.dashboard');
    Route::get('admin/pages/shipments/claimed', [AdminPageController::class, 'claimed'])->name('admin.pages.shipments.claimed');
    Route::get('admin/pages/shipments/unclaim', [AdminPageController::class, 'unclaim'])->name('admin.pages.shipments.unclaim');
});

Route::post('/weight/store', [WeightLimitController::class, 'store'])->name('weight.store');
Route::get('/weight/get', [WeightLimitController::class, 'getWeight'])->name('weight.get');
Route::get('/get-weight-limit', [WeightLimitController::class, 'getWeightLimit']);

Route::post('.admin/pages/company/branch', [BranchController::class, 'branch_store'])->name('branch.store');
Route::get('admin/pages/company/branch', [BranchController::class, 'index']);
Route::get('/admin/pages/company/branch', [BranchController::class, 'index'])->name('admin.pages.company.branch');
Route::put('/branch/update/{id}', [BranchController::class, 'update'])->name('branch.update');
Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branch.destroy');
Route::put('/branch/update-status/{id}', [BranchController::class, 'updateStatus']);

Route::post('admin/pages/rates/port', [RatesController::class, 'rates'])->name('port.store');
Route::put('/rates/update/{id}', [RatesController::class, 'update'])->name('rates.update');
Route::get('customer/pages/request_form', [RatesController::class, 'request_form'])->name('request_form');
Route::get('/admin/pages/rates/rates', [RatesController::class, 'index'])->name('admin.pages.rates.rates');
Route::delete('/port/{id}', [RatesController::class, 'destroy_port'])->name('port.destroy');
Route::put('/port/update-status/{id}', [RatesController::class, 'updateStatus']);

Route::get('/admin/pages/accounts/user', [UserController::class, 'index'])->name('admin.pages.accounts.user');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('branch.destroy');

Route::post('admin/pages/rates/categories', [CategoryController::class, 'store_category'])->name('categories.store');
Route::get('admin/pages/rates/categories', [CategoryController::class, 'index'])->name('admin.pages.rates.categories');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::get('admin/pages/company/contact_details', [CompanyController::class, 'showForm'])->name('admin.pages.company.contact_details');
Route::post('admin/pages/company/contact_details', [CompanyController::class, 'update'])->name('contact.details.update');

Route::post('admin/pages/accounts/teller', [TellerController::class, 'store'])->name('teller.store');
Route::get('admin/pages/accounts/teller', [TellerController::class, 'index'])->name('admin.pages.accounts.teller');
Route::put('/teller/update/{id}', [TellerController::class, 'update'])->name('teller.update');
Route::delete('/tellers/{id}', [TellerController::class, 'destroy'])->name('teller.destroy');
Route::post('teller/pages/change_password', [TellerController::class, 'changePassword'])->name('teller.changePassword');

Route::post('customer/index', [ContactUsController::class, 'contact_us'])->name('contact.store');

Route::post('customer/pages/request_form', [RequestController::class, 'store_request'])->name('request.store');


//Actions 
Route::post('teller/pages/request', [Submitted_RequestController::class, 'submitShipments'])->name('submit.shipments');
Route::get('admin/pages/shipments/submitted_request', [Submitted_RequestController::class, 'index'])->name('admin.pages.shipments.submitted_request');
Route::get('admin/pages/shipments/details/submitted_request/{id}', [Submitted_RequestController::class, 'show'])->name('admin.pages.shipments.details.submitted_request');

Route::get('admin/pages/shipments/queued', [QueuedController::class, 'index_admin'])->name('admin.pages.shipments.queued');
Route::get('admin/pages/shipments/details/queued/{id}', [QueuedController::class, 'show_admin'])->name('admin.pages.shipments.details.queued');
Route::get('admin/pages/shipments/in_transit', [InTransitShipmentController::class, 'index_admin'])->name('admin.pages.shipments.in_transit');
Route::get('admin/pages/shipments/details/in_transit/{id}', [InTransitShipmentController::class, 'show_admin'])->name('admin.pages.shipments.details.in_transit');

Route::post('admin/pages/shipments/approve_request', [Approved_RequestController::class, 'approveShipments'])->name('approve.shipments');
Route::get('teller/pages/approved', [Approved_RequestController::class, 'index'])->name('teller.pages.approved');
Route::get('teller/pages/details/approved/{id}', [Approved_RequestController::class, 'show'])->name('teller.pages.details.approved');

Route::post('admin/pages/shipments/decline_request', [Declined_RequestController::class, 'declineShipments'])->name('decline.shipments');
Route::get('teller/pages/declined', [Declined_RequestController::class, 'index'])->name('teller.pages.declined');
Route::get('teller/pages/details/declined/{id}', [Declined_RequestController::class, 'show'])->name('teller.pages.details.declined');

Route::post('admin/pages/shipments/queued', [QueuedController::class, 'updateDispatchDate'])->name('update.dispatch.date');
Route::post('/approved_shipment', [QueuedController::class, 'dispatchShipment'])->name('teller.pages.approved_shipment');
Route::get('teller/pages/queued', [QueuedController::class, 'index'])->name('teller.pages.queued');
Route::get('teller/pages/details/queued/{id}', [QueuedController::class, 'show'])->name('teller.pages.details.queued');

Route::post('/shipment-cancel', [CancelledController::class, 'cancelShipments_user'])->name('shipment_cancel');
Route::post('teller/pages/approved', [CancelledController::class, 'cancelShipments'])->name('cancel.shipments');
Route::get('admin/pages/shipments/cancelled', [CancelledController::class, 'index'])->name('admin.pages.shipments.cancelled');
Route::get('admin/pages/shipments/details/cancelled/{id}', [CancelledController::class, 'show'])->name('admin.pages.shipments.details.cancelled');

Route::post('teller/pages/queued', [InTransitShipmentController::class, 'startTransit'])->name('teller.queued.start_transit');
Route::get('teller/pages/in_transit', [InTransitShipmentController::class, 'index'])->name('teller.pages.in_transit');
Route::get('teller/pages/details/in_transit/{id}', [InTransitShipmentController::class, 'show'])->name('teller.pages.details.in_transit');

Route::post('teller/pages/in_transit', [DispatchController::class, 'shipmentDispatched'])->name('shipment_dispatched');
Route::get('teller/pages/dispatched', [DispatchController::class, 'index'])->name('teller.pages.dispatched');
Route::get('teller/pages/details/dispatched/{id}', [DispatchController::class, 'show'])->name('teller.pages.details.dispatched');

Route::get('admin/pages/shipments/dispatched', [DispatchController::class, 'index_admin'])->name('admin.pages.shipments.dispatched');
Route::get('admin/pages/shipments/details/dispatched/{id}', [DispatchController::class, 'show_admin'])->name('admin.pages.shipments.details.dispatched');
 
Route::get('/admin/pages/shipments/in_transit', [InTransitShipmentController::class, 'index_admin'])->name('admin.pages.shipments.in_transit');

Route::post('/claim-shipments', [ClaimedController::class, 'claim_shipment'])->name('claim.shipments');
Route::get('teller/pages/claimed', [ClaimedController::class, 'index_claim'])->name('teller.pages.claimed');
Route::get('teller/pages/details/claimed/{id}', [ClaimedController::class, 'show_claim'])->name('teller.pages.details.claimed');

Route::post('/unclaim-shipment', [UnclaimController::class, 'unclaim_shipment'])->name('unclaim.shipments');
Route::get('teller/pages/unclaimed', [UnclaimController::class, 'index_unclaim'])->name('teller.pages.unclaimed');
Route::get('teller/pages/details/unclaimed/{id}', [UnclaimController::class, 'show_unclaim'])->name('teller.pages.details.unclaimed');

Route::get('admin/pages/shipments/claimed', [ClaimedController::class, 'index_claim_admin'])->name('admin.pages.shipments.claimed');
Route::get('admin/pages/shipments/details/claimed/{id}', [ClaimedController::class, 'show_claim_admin'])->name('admin.pages.shipments.details.claimed');
Route::get('admin/pages/shipments/unclaim', [UnclaimController::class, 'index_unclaim_admin'])->name('admin.pages.shipments.unclaim');
Route::get('admin/pages/shipments/details/unclaim/{id}', [UnclaimController::class, 'show_unclaim_admin'])->name('admin.pages.shipments.details.unclaim');
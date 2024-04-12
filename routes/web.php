<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\category\ProductCategoryController;
use App\Http\Controllers\admin\category\ServiceCategoryController;
use App\Http\Controllers\admin\invoice\InvoiceController;
use App\Http\Controllers\admin\order\OrdersController;
use App\Http\Controllers\admin\products\MarketProductsController;
use App\Http\Controllers\admin\products\ProductsController;
use App\Http\Controllers\admin\products\SabProductsController;
use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\admin\StaffsController;
use App\Http\Controllers\admin\transactions\TransactionsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\seller\business\BankInfoController;
use App\Http\Controllers\seller\business\MyShopController;
use App\Http\Controllers\seller\business\MyWalletController;
use App\Http\Controllers\seller\business\ReviewsController;
use App\Http\Controllers\seller\orders\OrdersManagementController;
use App\Http\Controllers\seller\products\ProductsManagementController;
use App\Http\Controllers\seller\SellerDashboardController;
use App\Http\Controllers\seller\SellerLoginController;
use App\Http\Controllers\staff\customer\StaffCustomerController;
use App\Http\Controllers\staff\order\OrdersController as OrderOrdersController;
use App\Http\Controllers\staff\order\StaffOrdersController;
use App\Http\Controllers\staff\products\StaffProductsController;
use App\Http\Controllers\staff\StaffLoginController;
use App\Http\Controllers\staff\VetStaffController;
use App\Http\Controllers\WebsiteController;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.auth.login');
});

// administrator authentication routes
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('login/submit', [AdminLoginController::class, 'submit'])->name('admin.submit.login');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

// administrator routes
Route::group(['prefix' => 'admin'], function () {


    // dashboard routes
    Route::group(['prefix' => 'dashboard', 'middleware' => ['admin']], function () {
        Route::get('home', [AdminDashboardController::class, 'home'])->name('admin.dashboard.home');

    });


    //Management routes.
    Route::group(['middleware' => ['admin']], function () {

        //users routes

        //admin routes
         Route::group(['prefix' => 'admin'], function () {
            Route::get('admin', [AdminsController::class, 'index'])->name('admin.listadmins');
            Route::post('storeadmin', [AdminsController::class, 'store'])->name('admin.storeadmin');
            Route::put('update/admin{id}', [AdminsController::class, 'update'])->name('admin.update');
            Route::delete('destroy/admin', [AdminsController::class, 'destroy'])->name('admin.destroyadmin');

            Route::get('staff', [StaffsController::class, 'index'])->name('admin.liststaffs');
            Route::post('storestaff', [StaffsController::class, 'store'])->name('admin.storestaff');
            Route::put('update/staff{id}', [StaffsController::class, 'update'])->name('admin.updatestaff');
            Route::delete('destroy/staff', [StaffsController::class, 'destroy'])->name('admin.destroystaff');

         });

        //staff routes
        //  Route::group(['prefix' => 'admin'], function () {
        //     Route::get('staff', [StaffsController::class, 'index'])->name('admin.liststaffs');
        //     Route::post('storestaff', [StaffsController::class, 'store'])->name('admin.storestaff');
        //     Route::put('update/{id}', [StaffsController::class, 'update'])->name('admin.update');
        //     Route::delete('destroy', [StaffsController::class, 'destroy'])->name('admin.destroystaff');
        //  });

         //sab-users routes
        Route::group(['prefix' => 'vetinfo'], function () {
            Route::get('users', [UsersController::class, 'index'])->name('admin.listusers');
            Route::delete('destroy-buyer', [UsersController::class, 'destroyBuyer'])->name('agent.destroybuyer');
            Route::get('sellers', [UsersController::class, 'sellers'])->name('admin.listsellers');
            Route::put('update-seller/{id}', [UsersController::class, 'updateSeller'])->name('seller.update');
            Route::delete('destroy-seller', [UsersController::class, 'destroySeller'])->name('seller.destroyseller');
            Route::get('view-seller/{id}', [UsersController::class, 'viewSeller'])->name('seller.view');
            Route::get('agents', [UsersController::class, 'agents'])->name('admin.listagents');
            Route::post('storeagent', [UsersController::class, 'storeAgent'])->name('admin.storeagent');
            Route::put('update/{id}', [UsersController::class, 'updateAgent'])->name('agent.update');
            Route::delete('destroy', [UsersController::class, 'destroy'])->name('agent.destroyagent');
            Route::get('view-agent/{id}', [UsersController::class, 'viewAgent'])->name('agent.view-agent');
            Route::get('view-agentcard/{id}', [UsersController::class, 'viewAgentCard'])->name('agent.view-agent_card');
            Route::get('view-user/{id}', [UsersController::class, 'viewUser'])->name('admin.view-user');
            Route::get('branches', [UsersController::class, 'branches'])->name('admin.listbranches');
            Route::post('storebranch', [UsersController::class, 'storeBranch'])->name('admin.storebranch');
            Route::put('update-branch/{id}', [UsersController::class, 'updateBranch'])->name('branch.update');
            Route::delete('destroy-branch', [UsersController::class, 'destroyBranch'])->name('branch.destroybranch');

        });

        //Category routes

        // product category routes
        Route::group(['prefix' => 'product-categories'], function () {
            Route::get('productcategory', [ProductCategoryController::class, 'index'])->name('admin.listproductcategory');
            Route::post('storeprodcat', [ProductCategoryController::class, 'store'])->name('admin.storeprodcat');
            Route::put('updateProduct/{id}', [ProductCategoryController::class, 'update'])->name('admin.updateProduct');
            Route::delete('destroy', [ProductCategoryController::class, 'destroy'])->name('admin.destroyprodcat');
        });

        //service category routes
        Route::group(['prefix' => 'service-categories'], function () {
            Route::get('servicecategory', [ServiceCategoryController::class, 'index'])->name('admin.listservicecategory');
            Route::post('storeServCat', [ServiceCategoryController::class, 'storeServCat'])->name('admin.storeServCat');
            Route::put('updateService/{id}', [ServiceCategoryController::class, 'update'])->name('admin.update-service');
            Route::delete('destroy', [ServiceCategoryController::class, 'destroy'])->name('admin.destroyservice');
        });

         //Products routes

        //  admin products
        Route::group(['prefix' => 'admin-products'], function () {
            Route::get('list', [ProductsController::class, 'index'])->name('admin.products.listproducts');
            Route::post('store', [ProductsController::class, 'store'])->name('admin.products.store');
            Route::put('update/{id}', [ProductsController::class, 'update'])->name('admin.products.update');
            Route::delete('destroy', [ProductsController::class, 'destroy'])->name('admin.products.destroy');
            Route::get('product-details/{id}',[ProductsController::class, 'details'])->name('admin.products.details');
        });


        // sab products routes
        Route::group(['prefix' => 'sab-products'], function () {
            Route::get('list', [SabProductsController::class, 'list'])->name('admin.sabproducts.list');
            Route::post('store', [SabProductsController::class, 'store'])->name('admin.sabproducts.store');
            Route::put('update/{id}', [SabProductsController::class, 'update'])->name('admin.sabproducts.update');
            Route::delete('destroy', [SabProductsController::class, 'destroy'])->name('admin.sabproducts.destroy');
            Route::get('product-details/{id}',[SabProductsController::class, 'details'])->name('admin.sabproducts.details');

        });
        // Market products routes
        Route::group(['prefix' => 'market-products'], function () {
            Route::get('list', [MarketProductsController::class, 'list'])->name('admin.marketproducts.list');
            Route::delete('destroy', [MarketProductsController::class, 'destroy'])->name('admin.marketproducts.destroy');
            Route::put('update/{id}', [MarketProductsController::class, 'update'])->name('admin.marketproducts.update');
            Route::get('product-details/{id}', [MarketProductsController::class, 'details'])->name('admin.marketproducts.details');

        });
         //  Orders Routes
        Route::group(['prefix' => 'orders'], function () {
            Route::get('create-order', [OrdersController::class, 'orderForm'])->name('admin.createOrder');
            Route::post('store', [OrdersController::class, 'store'])->name('admin.storeOrder');
            Route::get('pendingorder', [OrdersController::class, 'pendingOrderindex'])->name('admin.pendingOrder');
            Route::put('update/{id}', [OrdersController::class, 'updateOrder'])->name('admin.pendingOrder.update');
            Route::delete('destroy', [OrdersController::class, 'destroyOrder'])->name('admin.order.destroy');
            Route::get('rejectedorder', [OrdersController::class, 'rejectedOrderindex'])->name('admin.rejectedorder');
            Route::get('completedorder', [OrdersController::class, 'completedOrderindex'])->name('admin.completedorder');
            Route::get('view-order/{id}', [OrdersController::class, 'viewOrder'])->name('admin.orders.vieworder');
        });

        // Invoice routes
        Route::group(['prefix' => 'invoices'], function () {
            Route::get('pendinginvoices', [InvoiceController::class, 'pendingInvoiceindex'])->name('admin.pendingInvoice');
            Route::delete('destroy', [InvoiceController::class, 'destroyInvoice'])->name('admin.pendingInvoice.destroy');
            Route::get('paidinvoices', [InvoiceController::class, 'paidInvoices'])->name('admin.paidInvoice');
            Route::get('overdueinvoices', [InvoiceController::class, 'overDueInvoices'])->name('admin.overDueInvoice');

        });

        // Transactions routes
        Route::group(['prefix' => 'transactions'], function () {
            Route::get('withdrawalReq', [TransactionsController::class, 'index'])->name('admin.withdrawalReq');
            Route::get('settledTrans', [TransactionsController::class, 'settledTrans'])->name('admin.settledTrans');
            Route::put('update/{id}', [TransactionsController::class, 'approve'])->name('admin.settledTrans.approve');
            Route::put('reject/{id}', [TransactionsController::class, 'reject'])->name('admin.settledTrans.reject');

        });

    });
});

// staff authentication routes
Route::group(['prefix' => 'staff'], function () {
    Route::get('login', [StaffLoginController::class, 'login'])->name('staff.login');
    Route::post('login/submit', [StaffLoginController::class, 'submit'])->name('staff.submit.login');
    Route::post('logout', [StaffLoginController::class, 'logout'])->name('staff.logout')->middleware('staff');
});

Route::group(['middleware' => ['staff']], function () {

    // staff management routes
    Route::group(['prefix' => 'staff'], function () {

        // orders routes
        Route::get('create-order', [StaffOrdersController::class,'orderForm' ] )->name('staff.createorder');
        Route::post('store', [StaffOrdersController::class, 'store'])->name('staff.storeOrder');
        Route::get('pendingorder', [StaffOrdersController::class, 'pendingOrderindex'])->name('staff.pendingOrder');
        Route::put('order/update/{id}', [StaffOrdersController::class, 'updateOrder'])->name('staff.pendingOrder.update');
        Route::delete('destroyorder', [StaffOrdersController::class, 'destroyOrder'])->name('staff.order.destroy');
        Route::get('rejectedorder', [StaffOrdersController::class, 'rejectedOrderindex'])->name('staff.rejectedorder');
        Route::get('completedorder', [StaffOrdersController::class, 'completedOrderindex'])->name('staff.completedorder');
        Route::get('view-order/{id}', [StaffOrdersController::class, 'viewOrder'])->name('staff.orders.vieworder');

        // customers routes
        Route::get('agents', [StaffCustomerController::class, 'agents'])->name('staff.listagents');
        Route::post('storeagent', [StaffCustomerController::class, 'storeAgent'])->name('staff.storeagent');
        Route::put('agent/update/{id}', [StaffCustomerController::class, 'updateAgent'])->name('staff.agent.update');
        Route::delete('destroyagent', [StaffCustomerController::class, 'destroy'])->name('staff.agent.destroyagent');
        Route::get('view-agent/{id}', [StaffCustomerController::class, 'viewAgent'])->name('staff.agent.view-agent');
        Route::get('view-agentcard/{id}', [StaffCustomerController::class, 'viewAgentCard'])->name('staff.agent.view-agent_card');

        // Products routes
        Route::get('list', [StaffProductsController::class, 'index'])->name('staff.products.listproducts');


    });


});

// seller authentication routes
Route::group(['prefix' => 'seller'], function () {
    Route::get('login', [SellerLoginController::class, 'login'])->name('seller.login');
    Route::post('login/submit', [SellerLoginController::class, 'submit'])->name('seller.submit.login');
    Route::post('logout', [SellerLoginController::class, 'logout'])->name('seller.logout')->middleware('seller');
});


//seller admin routes
Route::group(['prefix' => 'seller', 'middleware' => ['seller']], function () {

    // dashboard routes
    Route::group(['prefix' => 'home'], function () {
        Route::get('dashboard', [SellerDashboardController::class, 'dashboard'])->name('seller.dashboard');
    });

    //Orders Management Routes
    Route::group(['prefix' => 'orders'], function () {
        Route::get('pendingorders', [OrdersManagementController::class, 'pendingOrdersindex'])->name('seller.pendingOrders');
        Route::get('completedorders', [OrdersManagementController::class, 'completedOrdersindex'])->name('seller.completedOrders');
        Route::get('rejectedorders', [OrdersManagementController::class, 'rejectedOrdersindex'])->name('seller.rejectedOrders');
        Route::get('vieworder/{id}', [OrdersManagementController::class, 'viewOrder'])->name('seller.viewOrder');
        Route::get('paidorders', [OrdersManagementController::class, 'paidOrders'])->name('seller.paidOrders');
        Route::get('unpaidorders', [OrdersManagementController::class, 'unPaidOrders'])->name('seller.unPaidOrders');
    });

    // Products Management
    Route::group(['prefix' => 'products'], function () {
        Route::get('myProducts', [ProductsManagementController::class, 'myProductsIndex'])->name('seller.myproducts');
        Route::get('rejectedProducts', [ProductsManagementController::class, 'rejectedProducts'])->name('seller.rejectedProducts');
        Route::post('storeProduct', [ProductsManagementController::class, 'storeProduct'])->name('seller.storeProducts');
        Route::put('update/{id}', [ProductsManagementController::class, 'update'])->name('seller.updateProducts');
        Route::delete('destroy', [ProductsManagementController::class, 'destroy'])->name('seller.destroy');
        Route::get('product-details/{id}', [ProductsManagementController::class, 'details'])->name('seller.products-details');
    });

    //Business Management Routes
    Route::group(['prefix' => 'business'], function () {
        Route::get('my-shop', [MyShopController::class, 'index'])->name('seller.my-shop');
        Route::get('bank-info', [BankInfoController::class, 'index'])->name('seller.bank-info');
        Route::post('store-bank-info', [BankInfoController::class, 'store'])->name('seller.store-bank-info');
        Route::get('my-wallet', [MyWalletController::class, 'index'])->name('seller.my-wallet');
        Route::post('withdraw', [MyWalletController::class, 'withdraw'])->name('seller.withdraw');
        Route::get('reviews', [ReviewsController::class, 'index'])->name('seller.reviews');
    });

});

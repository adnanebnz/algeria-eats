<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetService;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeliveryManController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

/*---AUTH AND PROFILE SECTION---*/
// AUTH
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name(
    'login'
);

Route::post('/auth/login', [LoginController::class, 'login']);

Route::view('/auth/register', 'auth.register')->name('register');

Route::match(['get', 'post'], '/auth/logout', [
    LoginController::class,
    'logout',
])->name('logout');

// FORGOT PASSWORD
Route::get('/forgot-password', [PasswordResetService::class, 'index'])->name(
    'password.request'
);

Route::post('/forgot-password', [PasswordResetService::class, 'store'])->name(
    'password.email'
);

Route::get('/reset-password/{token}', [
    PasswordResetService::class,
    'showResetForm',
])->name('password.reset');

Route::post('/reset-password', [
    PasswordResetService::class,
    'resetPassword',
])->name('password.update');

// PROFILE
Route::get('profile/{user}', [ProfileController::class, 'index'])->name(
    'profile'
);

Route::put('profile/{user}', [ProfileController::class, 'update'])->name(
    'profile.update'
);

Route::delete('profile/{user}', [ProfileController::class, 'destroy'])->name(
    'profile.destroy'
);

/*---AUTH AND PROFILE SECTION END---*/

// INDEX
Route::view('/', 'index')->name('index');
// FAQ
Route::view('/faq', 'faq.index')->name('faq');
// ARTISANS PAGE (where we show and search for artisans)
Route::view('artisans', 'artisan.page')->name('artisan.page');

/*---CINTACT---*/
Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});
/*---CINTACT END---*/

/*---PRODUCTS---*/
Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});
/*---PRODUCTS END---*/

// CART
Route::view('/cart', 'cart.cart')->name('cart.index')->middleware('auth');

/*---CHECKOUT---*/
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [OrderController::class, 'checkout'])->name('index');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::post('/cancel', [OrderController::class, 'cancel'])->name('cancel');
});
/*---CHECKOUT END---*/

/*---USER DASHBOARD---*/
Route::get('user/dashobard', [ConsumerController::class, 'index'])->name(
    'user.dashobard'
);

Route::get('user/dashobard/orders', [
    ConsumerController::class,
    'ordersIndex',
])->name('user.orders');

Route::get('user/dashobard/orders/{order}', [
    ConsumerController::class,
    'showOrder',
])->name('user.orders.show');

Route::post('user/dashobard/orders/{order}/cancel', [
    ConsumerController::class,
    'cancelOrder',
])->name('user.orders.cancel');

Route::get('user/dashboard/delivery/{delivery}', [
    ConsumerController::class,
    'showDelivery',
])->name('user.delivery.show');
/*---USER DASHBOARD END---*/

/*---ARTISAN DASHBOARD---*/
Route::get('artisan/dashboard', [ArtisanController::class, 'index'])->name(
    'artisan.index'
);

// PRODUCTS SECTION
Route::get('artisan/dashboard/products', [
    ArtisanController::class,
    'productsIndex',
])->name('artisan.products');

Route::get('artisan/dashboard/products/new', [
    ArtisanController::class,
    'createProduct',
])->name('artisan.products.new');

Route::get('artisan/dashboard/products/{product}', [
    ArtisanController::class,
    'showProduct',
])->name('artisan.products.show');

Route::post('artisan/dashboard/products', [
    ArtisanController::class,
    'storeProduct',
])->name('artisan.products.store');

Route::get('artisan/dashboard/products/{product}/edit', [
    ArtisanController::class,
    'editProduct',
])->name('artisan.products.edit');

Route::put('artisan/dashboard/products/{product}/edit', [
    ArtisanController::class,
    'updateProduct',
])->name('artisan.products.update');

Route::delete('artisan/dashboard/products/{product}', [
    ArtisanController::class,
    'destroyProduct',
])->name('artisan.products.destroy');

//ORDERS SECTION
Route::get('artisan/dashboard/orders', [
    ArtisanController::class,
    'ordersIndex',
])->name('artisan.orders');

Route::get('artisan/dashboard/orders/{order}', [
    ArtisanController::class,
    'showOrder',
])->name('artisan.orders.show');

Route::put('artisan/dashboard/orders/{order}', [
    ArtisanController::class,
    'updateOrder',
])->name('artisan.orders.update');

Route::delete('artisan/dashboard/orders/{order}', [
    ArtisanController::class,
    'destroyOrder',
])->name('artisan.orders.destroy');

//DELIVERIES SECTION
Route::get('artisan/dashboard/deliveries', [
    ArtisanController::class,
    'deliveriesIndex',
])->name('artisan.deliveries');

Route::get('artisan/dashboard/deliveries/{delivery}', [
    ArtisanController::class,
    'showDelivery',
])->name('artisan.deliveries.show');

Route::post('artisan/dashboard/{order}/delivery', [
    ArtisanController::class,
    'affectDelivery',
])->name('artisan.deliveries.affect');

Route::post('artisan/dashboard/deliveries/{delivery}/unaffect', [
    ArtisanController::class,
    'unaffectDelivery',
])->name('artisan.deliveries.unaffect');

// PDF INVOICES
Route::post('artisan/dashboard/orders/{order}/invoice', [
    InvoicesController::class,
    'create',
])->name('artisan.orders.invoice');
/*---ARTISAN DASHBOARD END---*/

/*---ADMIN DASHBOARD---*/
Route::get('admin/dashboard', [AdminController::class, 'index'])->name(
    'admin.index'
);
// USERS
Route::get('admin/dashboard/users', [AdminController::class, 'usersIndex'])->name(
    'admin.users.index'
);

Route::get('admin/dashboard/users/{user}', [
    AdminController::class,
    'showUser',
])->name('admin.users.show');

Route::get('admin/dashboard/users/{user}/edit', [
    AdminController::class,
    'userEdit',
])->name('admin.users.edit');

Route::put('admin/dashboard/users/{user}', [
    AdminController::class,
    'userUpdate',
])->name('admin.users.update');

Route::delete('admin/dashboard/users/{user}', [
    AdminController::class,
    'userDestroy',
])->name('admin.users.destroy');
// PRODUCTS

Route::get('admin/dashboard/products', [AdminController::class, 'productsIndex'])->name('admin.products.index');
Route::get('admin/dashboard/products/{product}', [AdminController::class, 'productsShow'])->name('admin.products.show');
Route::get('admin/dashboard/products/{product}/edit', [AdminController::class, 'productsEdit'])->name('admin.products.edit');
Route::put('admin/dashboard/products/{product}', [
    AdminController::class,
    'productUpdate',
])->name('admin.products.update');
Route::delete('admin/dashboard/products/{product}', [
    AdminController::class,
    'productsDestroy',
])->name('admin.products.destroy');

// CONTACT
Route::get('admin/dashboard/messages', [
    AdminController::class,
    'messagesIndex',
])->name('admin.messages.index');

Route::get('admin/dashboard/messages/{message}', [
    AdminController::class,
    'messagesShow',
])->name('admin.messages.show');

Route::delete('admin/dashboard/messages/{message}', [
    AdminController::class,
    'messagesDestroy',
])->name('admin.messages.destroy');
/*---ADMIN END---*/

/*---DELIVERY MAN---*/
Route::get('deliveryMan/dashboard', [
    DeliveryManController::class,
    'index',
])->name('deliveryMan.index');

//deliveries  SECTION
Route::get('deliveryMan/dashboard/deliveries', [
    DeliveryManController::class,
    'deliveriesIndex',
])->name('deliveryMan.deliveries');

Route::get('deliveryMan/dashboard/deliveries/{delivery}', [
    DeliveryManController::class,
    'showDelivery',
])->name('deliveryMan.deliveries.showDelivery');

Route::get('deliveryMan/dashboard/pending-deliveries', [
    DeliveryManController::class,
    'pendingDeliveries',
])->name('deliveryMan.deliveries.showPendingDeliveries');

Route::get('deliveryMan/dashboard/finished-deliveries', [
    DeliveryManController::class,
    'finishedDeliveries',
])->name('deliveryMan.deliveries.showFinishedDeliveries');

Route::post('deliveryMan/{delivery}/accept', [
    DeliveryManController::class,
    'accept',
])->name('delivery.accept');

Route::put('deliveryMan/{delivery}/update', [
    DeliveryManController::class,
    'updateDelivery',
])->name('delivery.updateDelivery');
/*---DELIVERY MAN END---*/

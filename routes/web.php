<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CheckAuthController;
use App\Http\Controllers\Frontend\AdPostController;
use App\Http\Controllers\Frontend\SettingsController;
use App\Http\Controllers\Frontend\ProfilesController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CityController;
use App\Http\Controllers\Frontend\BusinessProductsController;
use App\Http\Controllers\Frontend\BusinessInfoController;
use App\Http\Controllers\Frontend\EventCategoryController;
use App\Http\Controllers\Frontend\FundraisingCategoryController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\FundraisingController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\NgoUserController;
use App\Http\Controllers\Frontend\UserOrdersController;
use App\Http\Controllers\Frontend\JobPostController;
use App\Http\Controllers\Frontend\CandidateInfoController;
use App\Http\Controllers\Website\AllAdsListController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\NewsletterController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\CategoryController;
use App\Http\Controllers\Website\SearchController;
use App\Http\Controllers\Website\CouponController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\BusinessController;
use App\Http\Controllers\Website\EventsController;
use App\Http\Controllers\Website\FundraisingsController;
use App\Http\Controllers\Website\NgoController;
use App\Http\Controllers\Website\JobsController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CheckoutController;
use App\Http\Controllers\Website\BlogsController;
use App\Http\Controllers\Website\HelpcenterController;
use App\Http\Controllers\Website\CandidateProfileController;
use App\Http\Controllers\Website\WebhookController;
use App\Http\Controllers\Website\PriceController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController as UserauthController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Website\TicketController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\ProductAttributeController;
use App\Http\Controllers\BusinessClaimController;
use App\Http\Controllers\ContactSellerController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Website\CategoryCandidatesController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use Intervention\Image\Facades\Image;
use App\Models\OrderEvent;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use Illuminate\Support\Facades\Mail;


Route::get('/gd-check', function() {
    $gd = gd_info();
    return [
        'GD Enabled' => extension_loaded('gd') ? 'Yes' : 'No',
        'PNG Support' => $gd['PNG Support'] ?? 'No',
    ];
});

Route::get('/scan', function () {
    return view('scan');
});

Route::get('send-email', function() {
    \Mail::raw('Test email content', function ($message) {
        $message->to('nadeem.pharos@gmail.com')->subject('Test Email');
    });
});

Route::get('/ticket-details/{order_id}', function ($order_id) {
    $order = OrderEvent::where('order_event_unique_id', $order_id)
                        ->with('user', 'orderTickets', 'event')
                        ->first();

    if (!$order) {
        return abort(404, 'Ticket not found');
    }

    return view('ticket-details', compact('order'));
});

Route::get('/pending-approval', function () {
    return view('components.pending-approval');
})->name('user.pending-approval')->middleware('auth');

Route::get('/mini-cart', [CartController::class, 'miniCart'])->name('mini.cart');

Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/create-ngo-thumbnails', [HomeController::class, 'createNGOThumbnails']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('sample', [HomeController::class, 'index_new'])->name('index_new'); 


// static pages 
Route::view('terms-of-use', 'website.terms-and-condition')->name('terms-of-use');

Route::view('about-us', 'website.about');
Route::view('thank-you', 'website.thank-you')->name('thank-you');
Route::view('help-center-old', 'website.helpcenter');

// Pricing
Route::get('pricing-list', [PriceController::class, 'index'])->name('price.list');
Route::get('/pricing-details/{slug}', [PriceController::class, 'details'])->name('price.details');

Route::get('/zohoverify/verifyforzoho.html', function () {
    return response()->file(resource_path('views/zohoverify/verifyforzoho.html'));
});
Route::view('delete-account', 'website.delete_account')->name('delete-account'); 
Route::post('/delete-account', [AccountController::class, 'deleteAccount'])->name('account.delete');

Route::view('privacy-policy', 'website.privacy')->name('privacy-policy');

Route::get('/offline', function () {return view('website.offline');})->name('offline');

// jobs routes  
Route::get('jobs-listing', [JobsController::class, 'index'])->name('jobs.list');
Route::get('job-details/{slug}', [JobsController::class, 'details'])->name('job.details')->middleware(['admin.approved']);
Route::post('/apply-job/{id}', [JobsController::class, 'applyJob'])->name('apply.job')->middleware(['admin.approved']);
Route::post('/guest-apply-job', [JobsController::class, 'guestApplyJob'])->name('guest.job.apply')->middleware(['admin.approved']);


// candidate
Route::get('/professionals', [CandidateProfileController::class, 'index'])->name('candidates.index');
Route::get('/candidate-details/{id}', [CandidateProfileController::class, 'details'])->name('candidate.details')->middleware(['admin.approved']);
Route::get('/download-resume/{id}', [CandidateProfileController::class, 'downloadResume'])->name('download.resume')->middleware(['admin.approved']);
Route::post('/contact/send', [CandidateProfileController::class, 'send'])->name('contact.send')->middleware(['admin.approved']);


// help center 
Route::get('help-center', [HelpcenterController::class, 'index'])->name('helpcenter.list'); 
Route::get('help-center/{slug}', [HelpcenterController::class, 'show'])->name('helpcenter.view'); 
Route::get('help-center/subcategory/{slug}', [HelpcenterController::class, 'subcategory'])->name('helpcenter.subcategory');

 
 
Route::get('blogs', [BlogsController::class, 'index'])->name('blogs'); 
Route::get('blog/{slug}', [BlogsController::class, 'show'])->name('blog.show'); 
Route::post('/enquiry/submit', [EnquiryController::class, 'submitEnquiry'])->name('enquiry.submit');

Route::get('/check-login', function () {
    return response()->json([
        'isLoggedIn' => auth()->check()
    ]);
});

Route::get('verify-email-expired', function () {
    return view('auth.verify-email-expired');
})->name('verification.expired');

// Forgot password
Route::get('user/forgot-password', [PasswordResetLinkController::class, 'create'])->name('user.password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');


Route::get('profile/user/{slug}', [HomeController::class, 'userProfile'])->name('Userprofile');
Route::get('author/{slug}', [HomeController::class, 'userProfile'])->name('seller.profile');
 // Check user is logged in or not
 Route::get('/user/check-auth', [CheckAuthController::class, 'check'])->name('user.checkAuth');
    
 // User authentication routes
 Route::middleware(['no.cache', 'guest'])->group(function () {
     Route::get('login', [UserauthController::class, 'userlogin'])->name('user.login'); 
     Route::post('process-login', [UserauthController::class, 'store'])->name('loginprocess');
     Route::post('register', [UserauthController::class, 'register'])->name('registrationProcess');
 });


    // Business routes 
    Route::prefix('business')->group(function () {
        Route::get('/list', [BusinessController::class, 'listBusinesses'])->name('business.list');
        Route::get('{businessInfo}', [BusinessController::class, 'viewBusiness'])->name('business.view');
        Route::get('{slug}', [BusinessController::class, 'showBySlug'])->name('business.show');
        Route::get('{businessInfo:slug}/products', [BusinessController::class, 'listProductByBusiness'])
            ->where('slug', '[a-zA-Z0-9-]+')
            ->name('product.list');
        
        Route::get('categories', [BusinessCategoryController::class, 'getCategories'])->name('categories.get');
        Route::post('/business/claim', [App\Http\Controllers\Website\BusinessController::class, 'claimBusiness'])->name('business.claim')->middleware('auth');
        
        Route::post('/ajax-search-business-category-by-id', [BusinessCategoryController::class, 'ajaxSearchBusinessCategoryById'])->name('ajaxSearchBusinessCategoryById');
    });

    //Business Claim routes
    Route::get('/claim/create', [BusinessClaimController::class, 'create'])->name('claim.create');
    Route::post('/claim/store', [BusinessClaimController::class, 'store'])->name('claim.store');
    Route::get('/claim/check-existing', [BusinessClaimController::class, 'checkExistingClaims'])->name('claim.check-existing');

    // Business Product
    Route::prefix('shop')->group(function () {
        Route::get('/products', [BusinessController::class, 'filterProducts'])->name('product.filter');

        Route::get('/{item_url}/view', [BusinessController::class, 'productDetailsByURL'])->where('item_url', '.*')->name('BusinessProduct.view');

        Route::post('/check-if-purchased', [ProductController::class, 'checkIfPurchased']);
    });
    Route::post('/contact-seller', [ContactSellerController::class, 'store'])->name('contact.seller');

    // Events routes
    Route::prefix('events')->group(function () { 
        Route::post('enquiry', [EventsController::class, 'events_enquiry'])->name('events.enquiry');
        Route::get('events-list', [EventsController::class, 'index'])->name('events.list');
        Route::get('details/{slug}', [EventsController::class, 'events_details'])->name('event.show');
        Route::post('{event}/update-count', [EventsController::class, 'updateCount']);
        Route::get('{encryptedEvent}/tickets', [TicketController::class, 'show'])->name('ticket.details');

        // Route::get('/view-tickets', [TicketController::class, 'viewticket'])->name('ticket.view');
        
    }); 
    Route::get('pricing', [EventsController::class, 'pricing'])->name('pricing');




    // Coupun 
    Route::post('/validate-coupon', [CouponController::class, 'validateCoupon'])->name('coupon.validate');

    // Order for event 
    // Route::post('/event-booking', [OrderController::class, 'create'])->name('orders.create');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update'); 
    Route::post('/event/process-payment', [OrderController::class, 'cartPayment'])->name('cartProcess.payment');
    Route::get('/sold-event-ticket-listing', [OrderController::class, 'getEventTicketListing'])->name('sold.event.ticket');
    Route::post('/order/redirect-to-square', [OrderController::class, 'redirectToSquareCheckout']);
    Route::get('/payment-success', [OrderController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [OrderController::class, 'paymentCancel'])->name('payment.cancel');
    

    Route::post('/shop/process-payment', [cartController::class, 'processPayment'])->name('process.payment');
    Route::post('/set-intended-url', [cartController::class, 'setIntendedUrl'])->name('set.intended.url');
    Route::get('/payment-redirect', [cartController::class, 'redirectToPayment'])->name('redirect.to.payment');
    // Route::post('/orders/complete', [OrderController::class, 'complete'])->name('orders.complete');





    //fundaraising routes
    Route::get('fundraising-list', [FundraisingsController::class, 'index'])->name('fundaraising.list');
    Route::get('fundraising-details/{slug}', [FundraisingsController::class, 'fundaraising_details'])->name('fundaraising.show');
    Route::get('fundraising-support/{slug}', [FundraisingsController::class, 'support'])->name('fundaraising.support');
    Route::get('fundraising-apply/{slug}', [FundraisingsController::class, 'apply'])->name('fundaraising.apply');
    Route::post('category-candidates/store', [CategoryCandidatesController::class, 'store'])->name('categorycandidates.store');


    Route::post('fundraising/donations', [FundraisingsController::class, 'store'])->name('donations.store');
    Route::post('donations/create_session', [FundraisingsController::class, 'createSession'])->name('donations.create_session');
    Route::post('donations/update_session', [FundraisingsController::class, 'updateSession'])->name('donations.update_session');

    // Optional: For handling failed transactions via pages (if needed later)
    Route::get('donations/success', function () { return view('website.fundraisings.success'); })->name('donations.success');
    Route::get('donations/error', function () { return view('website.fundraisings.error'); })->name('donations.error');

    // NGO's Routes  
    Route::get('sabz-future', [NgoController::class, 'index'])->name('ngo.list');
    Route::get('sabz-future/{id}', [NgoController::class, 'show'])->name('ngo.show');
    Route::post('user/join', [NgoController::class, 'join'])->name('user.join');
    Route::post('leave-ngo', [NgoController::class, 'leave'])->name('user.leave');


    // cart  and checkoutroutes  
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/contents', [CartController::class, 'getCartContents'])->name('cart.getContents');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');

    Route::get('/cart/get', [CartController::class, 'getCart'])->name('cart.get');
    Route::post('/cart/remove', [CartController::class,'remove'])->name('cart.removeItem');

    // checkout for store 
    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processPayment'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'handlePaymentSuccess'])->name('checkout.success');
    Route::get('/checkout/failed', [CheckoutController::class, 'handlePaymentFailed'])->name('checkout.failed');
    Route::get('/payment/cancel', [CheckoutController::class, 'handlePaymentCancel'])->name('payment.cancel');
    Route::post('/webhooks/square', [WebhookController::class, 'handleWebhook']);


    //store order 
    Route::get('/my-orders', [UserOrdersController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/itemorders/{id}', [UserOrdersController::class, 'vieworder'])->name('myorders.view');
    Route::post('/customer/order-item/status/update', [UserOrdersController::class, 'updateCustomerOrderItemStatus'])->name('customer.order.item.status.update');

    Route::get('/my-tickets-orders', [UserOrdersController::class, 'mytickets'])->name('ordersticket.index');
    Route::get('/my-tickets/{id}/details', [UserOrdersController::class, 'viewTicketOrder'])
        ->name('tickets.details');
    Route::get('/my-donations', [DonationController::class, 'index'])->name('donation.index');
    // Newsletter routes 
    Route::post('newsletter', [NewsletterController::class, 'newslettersubmitForm'])->name('newsletter-form.submit');

    // Contact routes 
    Route::get('contactus', [ContactController::class, 'index'])->name('show.contact-us');
    Route::post('contactus', [ContactController::class, 'submitForm'])->name('contact-us.submit');


    // City routes
    Route::get('cities', [CityController::class, 'index'])->name('cities.index');

    // Category routes
    Route::prefix('category')->group(function () {
        Route::get('list', [ProductController::class, 'categoryList'])->name('products.category_list');
        Route::get('{category}', [ProductController::class, 'category_index'])->name('products.by_category');
        Route::get('{category}/{subcategory?}', [ProductController::class, 'category_index'])
            ->where(['category' => '(?!admin)[\w-]+', 'subcategory' => '[a-z\-]+'])
            ->name('products.by_subcategory');
    });

    

    // Ad Post routes
    Route::prefix('ads-post')->group(function () {
        Route::get('list', [ProductController::class, 'index'])->name('adsList');
        Route::post('submit-report', [ProductController::class, 'submitReport'])->name('submitReport');
        
        // Route for the specific URL structure
        Route::get('products/{item_url}', [ProductController::class, 'showByURL'])
            ->where('item_url', '.*')
            ->name('product.show');
    });




    


    // Search routes
    Route::prefix('search')->group(function () {
        Route::get('/', [SearchController::class,'headerSearch'])->name('search.header');
        Route::get('more/ad_posts', [SearchController::class,'moreAdPosts'])->name('search.more_ad_posts');
        Route::get('more/businesses', [SearchController::class, 'moreBusinesses'])->name('search.more_businesses');
        Route::get('more/business_products', [SearchController::class,'moreBusinessProducts'])->name('search.more_business_products');
    });
    // In routes/web.php or routes/frontend.php
    Route::get('/search/suggest', [SearchController::class, 'suggestSearch'])->name('search.suggest');


    // Wishlist routes
    Route::prefix('wishlist')->group(function () {
        Route::post('add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
        Route::get('/list', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::delete('/remove', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
        Route::delete('/delete', [WishlistController::class, 'directDelete'])->name('wishlist.delete');
        Route::get('count', [WishlistController::class, 'getCount'])->name('wishlist.count');

    });

    // All Ads
        Route::get('all-ads-list', [AllAdsListController::class, 'index'])->name('ads-list.index');
        Route::get('ads/{id}', [AllAdsListController::class, 'show'])->name('ads.show');
        
        // route for category
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/getCategory', [AdPostController::class, 'categoryList'])->name('getCategory');
        Route::post('/getSubcategory', [AdPostController::class, 'subcategoryList'])->name('getSubcategory');
        Route::post('/get-category', [EventsController::class, 'eventCategory'])->name('getEventCategory');
        Route::get('/product-categories', [BusinessCategoryController::class, 'product_category'])->name('product.categories');
        
   

    // Event Ticket
        Route::post('/event/{id}/purchase', [TicketController::class, 'purchaseTicket'])->name('event.purchase');
        
        Route::get('/event/{encryptedOrderId}/success', [TicketController::class, 'showSuccess'])->name('event.success');
        Route::get('/verify-ticket/{hash}', [TicketController::class, 'verifyTicket'])->name('ticket.verify');
        Route::post('event/toggle-attendee-presence', [TicketController::class, 'toggleAttendeePresence'])->name('attendee.togglePresence');
        

        Route::get('/payment/status', [TicketController::class, 'paymentStatus'])->name('payment.status');
        Route::get('/payment/success', [TicketController::class, 'paymentSuccess'])->name('event.payment.success');
    // Pdf ticket
    
    Route::get('/download-pdf/{order_event_unique_id}', [TicketController::class, 'downloadTicket'])->name('downloadOrderPdf');
    // Route::get('/download-pdf/{hash}', [TicketController::class, 'downloadTicket'])->name('ticket.verify');

    // barcode
    Route::get('/tickets/{hash}', [TicketController::class, 'getTicketInfo'])->name('short.url');
    
    
    // Routes for authenticated but potentially unverified users
    Route::middleware(['auth', 'no.cache'])->group(function () {
        Route::get('profile', [ProfilesController::class, 'index'])->name('profile');
        Route::get('profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile-edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('profile-edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Routes for verified users
    Route::middleware(['auth', 'verified', 'no.cache'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/api/event-categories', [EventCategoryController::class, 'searchCategories'])->name('api.event-categories');
        
        Route::get('basic-info', [SettingsController::class, 'index'])->name('basicInfo');
        Route::patch('basic-info-update', [SettingsController::class, 'updateBasicInfo'])->name('basicInfo.update');
        Route::get('billing-info', [SettingsController::class, 'billing'])->name('billingInfo');
        Route::patch('billing-info-update', [SettingsController::class, 'billingUpdate'])->name('updateBillingInfo');
        Route::get('shipping-info', [SettingsController::class, 'shipping'])->name('shippingInfo');
        Route::patch('shipping-info-update', [SettingsController::class, 'shippingUpdate'])->name('updateShippingInfo');
        Route::get('seller/{id}', [ProfilesController::class, 'show'])->name('profile.view');
        Route::post('user/make-business', [ProfilesController::class, 'makeBusinessAccount'])->name('user.makeBusiness');
        Route::get('ngo-info', [SettingsController::class, 'ngo'])->name('ngoInfo');
        Route::patch('ngo-info-update', [SettingsController::class, 'ngoUpdate'])->name('updateNgoInfo');
        Route::get('ngo-address-info', [SettingsController::class, 'ngoAddress'])->name('ngo.address');
        Route::patch('ngo-address-update', [SettingsController::class, 'ngoAddressUpdate'])->name('ngo.updateAddressInfo');
        Route::get('ngo-social-info', [SettingsController::class, 'ngoSocial'])->name('ngo.social');
        Route::patch('ngo-social-update', [SettingsController::class, 'ngoSocialUpdate'])->name('ngo.updateSocialInfo');
        Route::get('ngo-other-info', [SettingsController::class, 'ngoMain'])->name('ngo.other'); 
        Route::patch('ngo-main-info-update', [SettingsController::class, 'ngoMainInfoUpdate'])->name('updateNgoMainInfo');
        Route::get('ngo-team-members', [SettingsController::class, 'ngoTeamMembers'])->name('ngo.team');
        Route::post('ngo-add-member', [SettingsController::class, 'addMember'])->name('ngo.addMember');
        Route::get('ngo-edit-member/{id}', [SettingsController::class, 'editMember'])->name('ngo.editMember');
        Route::put('ngo-update-member/{id}', [SettingsController::class, 'updateMember'])->name('ngo.updateMember');
        Route::delete('ngo-delete-member/{id}', [SettingsController::class, 'deleteMember'])->name('ngo.deleteMember');
        
        Route::get('/order/success', function () {
            return view('order.success'); 
        })->name('order.success');
        
        // Jobs
        Route::get('/user/jobs', [JobPostController::class, 'index'])->name('jobs');
        Route::get('/jobs/create', [JobPostController::class, 'create'])->name('jobs.create');
        Route::post('/jobs/store', [JobPostController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/edit/{slug}', [JobPostController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/update/{slug}', [JobPostController::class, 'update'])->name('jobs.update');
        Route::get('/jobs/{jobId}/applications', [JobPostController::class, 'showJobApplications'])->name('jobs.applications');
        Route::get('/candidates/details/{candidateId}/{candidateType}', [JobPostController::class, 'getCandidateDetails'])->name('candidates.details');
        Route::delete('jobs/delete/{slug}', [JobPostController::class, 'destroy'])->name('jobs.destroy');
        
        // Fundraising
        Route::get('fundraising', [FundraisingController::class, 'index'])->name('fundraising.index');
        Route::get('fundraising/create', [FundraisingController::class, 'add'])->name('fundraising.add');
        Route::post('fundraisingcreate', [FundraisingController::class, 'store'])->name('fundraising.create');
        Route::post('/api/fundraising-categories', [FundraisingCategoryController::class, 'getCategories'])->name('api.fundraising-categories');
        Route::get('fundraising/{slug}/edit', [FundraisingController::class, 'edit'])->name('fundraising.edit');
        Route::put('fundraising/{slug}', [FundraisingController::class, 'update'])->name('fundraising.update');
        Route::delete('fundraising/{slug}', [FundraisingController::class, 'destroy'])->name('fundraising.destroy');
        
        // NGO
        Route::get('organization-info', [NgoUserController::class, 'index'])->name('organization.index');
        
        // AdPost
        Route::patch('ad-post/delete-image', [AdPostController::class, 'deleteImage'])->name('ad-post.delete-image');
        Route::resource('ad-post', AdPostController::class); 
        Route::get('ad-post/{item_url}/view', [AdPostController::class, 'showBySlug'])->where('item_url', '.*')->name('posts.showByUrl');
        Route::get('/ad-post/{id}/report', [AdPostController::class, 'showReport'])->name('ad-post.showReport');
        Route::delete('/report/{id}', [AdPostController::class, 'deleteReport'])->name('report.delete');
        Route::get('ad-post/{category}/{slug}/{datetime}', [AdPostController::class, 'edit'])->name('posts.edit');
        Route::put('ad-post/{category}/{slug}/{datetime}', [AdPostController::class, 'update'])->name('ad-posts.update');
        Route::delete('ads-post/products/{item_url}/delete', [AdPostController::class, 'destroy'])->where('item_url', '.*')->name('posts.destroy');
        Route::get('/enquiries/{post_slug}', [AdPostController::class, 'showPostsEnquiries'])->where('post_slug', '.*')->name('enquiries.adspost');
        
        Route::post('/event/{slug}/interested', [EventController::class, 'toggleInterested']);
Route::post('/event/{slug}/going', [EventController::class, 'toggleGoing']);

        // Reviews
        Route::post('submit-business-product-review/{slug}', [ReviewController::class, 'submitBusinessProductReview'])->where('slug', '.*')->name('submit_business_product_review');
        Route::post('submit-post-review/{item_url}', [ReviewController::class, 'submitAdPostReview'])->where('item_url', '.*')->name('submit_ad_post_review');
        Route::post('submit-report/{postId}', [AllAdsListController::class, 'submitReport'])->name('submit_report');
        
        // Business Controller
        Route::get('business-info', [BusinessInfoController::class, 'index'])->name('business-info.index');
        Route::post('info/store', [BusinessInfoController::class, 'store'])->name('business.info.store');
        Route::post('info/update/{id}', [BusinessInfoController::class, 'update'])->name('business.info.update');
        Route::post('hour/store', [BusinessInfoController::class, 'storeHour'])->name('business.hour.store'); 
        Route::post('hour/update/{id}', [BusinessInfoController::class, 'updateHour'])->name('business.hour.update');
        Route::post('business-info/image/delete', [BusinessInfoController::class, 'deleteImage'])->name('business.info.delete.image');
        Route::get('/business-enquiries/{business_name}', [BusinessInfoController::class, 'showBusinessEnquiries'])->name('enquiries.business');
        Route::delete('business/enquiries/{id}', [BusinessInfoController::class, 'deleteEnquiry'])->name('business.enquiry.delete');
        Route::post('/search-business-category', [BusinessInfoController::class,'searchBusinessCategory'])->name('ajaxBusinessCategory');
        
        // Business Products
        Route::get('list-business-products', [BusinessProductsController::class, 'index'])->name('business-products.index');
        Route::get('list-business-products-enquiries', [BusinessProductsController::class, 'enquiries'])->name('business-products.productEnquiries');
        Route::get('business/products/create', [BusinessProductsController::class, 'create'])->middleware('check.business.product.creation')->name('business-products.create');
        Route::post('business/products/store', [BusinessProductsController::class, 'store'])->name('business-products.store');
        Route::get('business/products/{item_url}/edit', [BusinessProductsController::class, 'edit'])->where('item_url', '.*')->name('business-products.edit');
        Route::put('business/products/{item_url}', [BusinessProductsController::class, 'update'])->where('item_url', '.*')->name('business-products.update');
        Route::get('business/products-details/{item_url}', [BusinessProductsController::class, 'showByURL'])->where('item_url', '.*')->name('BusinessProduct.show');
        Route::patch('business/products/{product}/delete-image', [BusinessProductsController::class, 'deleteImage'])->name('business-products.delete-image');
        Route::delete('business/products/{item_url}', [BusinessProductsController::class, 'destroy'])->where('item_url', '.*')->name('business-products.destroy');
        Route::get('business/products/orders', [BusinessProductsController::class, 'myproductorder'])->name('business-products.order');
        Route::get('business/products/order/{id}', [BusinessProductsController::class, 'viewOrderDetails'])->name('orders.view');
        Route::post('business/order-status-change/{id}', [BusinessProductsController::class, 'changeOrderStatus'])->name('orders.changeStatus');
        
        // Candidate
        Route::get('professional/profile/{candidateId}', [CandidateInfoController::class, 'index'])->name('candidate-info.index');
        Route::post('professional-info/store', [CandidateInfoController::class, 'store'])->name('candidate.info.store');
        Route::put('professional-info/update/{id}', [CandidateInfoController::class, 'updateProfile'])->name('candidate.update');
        Route::post('/toggle-bookmark/{profileId}', [CandidateInfoController::class, 'toggleBookmark'])->name('toggle.bookmark');
        
        // Events
        Route::get('category', [EventController::class, 'category_index'])->name('event.category');
        Route::get('/user-events-list', [EventController::class, 'index'])->name('events.index');
        Route::get('list', [EventController::class, 'fetchTableData'])->name('EventsList');
        Route::get('user-event-add', [EventController::class, 'add'])->name('events.add');
        Route::post('create', [EventController::class, 'store'])->name('events.create');
        Route::get('user-event-tickets', [EventController::class, 'getUserTickets'])->name('events.tickets-list');
        Route::get('seller-event-tickets', [EventController::class, 'getSellerTickets'])->name('events.seller-tickets-list');
        Route::get('/order-details/{encryptedOrderId}', [EventController::class, 'viewOrderDetails'])->name('order.details');
        Route::get('event/{slug}/edit', [EventController::class, 'edit'])->name('EventsEdit');
        Route::put('event/{slug}', [EventController::class, 'update'])->name('EventsUpdate'); 
        Route::delete('/events/{slug}', [EventController::class, 'destroy'])->name('event.destroy');
        Route::get('events/{event_slug}/enquiries', [EventController::class, 'showEventEnquiries'])->name('event.enquiries.show');
        Route::patch('/event/{slug}/delete-image', [EventController::class, 'deleteImage']);
        Route::delete('events/enquiries/{id}', [EventController::class, 'deleteEnquiry'])->name('event.enquiry.delete');
        Route::get('events/{event_slug}/booking', [EventController::class, 'bookingEvent'])->name('event.booking.show');
        Route::delete('events/bookings/{id}', [EventController::class, 'deleteBooking'])->name('bookings.delete');
        Route::get('events/my-tickets', [EventController::class, 'myTickets'])->name('user.tickets');
        Route::get('events/my-event-sales', [EventController::class, 'myEventSales'])->name('host.event.sales');
        Route::get('event/{event}/tickets', [EventController::class, 'eventTickets'])->name('event.tickets');
        Route::get('{event}/show', [EventController::class, 'show'])->name('events.show');
    });


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/theme.php';
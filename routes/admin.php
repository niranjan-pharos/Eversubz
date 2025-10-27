<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\EventsCategoryController;
use App\Http\Controllers\admin\FundraisingCategoryController;
use App\Http\Controllers\admin\AdPostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\BlogsController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\BusinessController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\JobsController;
use App\Http\Controllers\admin\JobsCategoryController;
use App\Http\Controllers\admin\NgoController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\FundraisingController;
use App\Http\Controllers\admin\NgoCategoryController;
use App\Http\Controllers\admin\NgoMemberController;
use App\Http\Controllers\admin\FaqCategoryController;
use App\Http\Controllers\admin\FaqSubcategoryController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\ProfessionalController;
use App\Http\Controllers\admin\TicketCategoryController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\admin\AttributesController;
use App\Http\Controllers\admin\DonationPackageController;
use Illuminate\Support\Facades\Route;

// Unprotected login routes
Route::get('/admin/login', [AdminController::class, 'login'])->name('adminLogin');
Route::post('/admin/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');

// Protected routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('adminProfile');
    Route::get('/profile-update', [ProfileController::class, 'update'])->name('updateProfile');

    // category
    Route::resource('/category', CategoryController::class)->names([
        'index' => 'adminCategory', 
    ]);

    // Business category 
    Route::get('/business-category', [CategoryController::class, 'businessCategoryIndex'])->name('businessCategory.index');
    Route::get('/business-fetch-category', [CategoryController::class, 'fetchbusinessCategoryData'])->name('businessCategoryList');
    Route::post('/process-business-category', [CategoryController::class, 'businessCategoryStore'])->name('businessCategory.store');
    Route::put('/business-update', [CategoryController::class, 'businessCategoryUpdate'])->name('businessCategoryUpdate');
    Route::delete('/business-delete', [CategoryController::class, 'businessCategorydestroy'])->name('businessCategoryDelete'); 
    Route::post('/search-business-category', [CategoryController::class,'searchBusinessCategory'])->name('ajaxSearchBusinessCategory');

    Route::put('/change-category-status',[CategoryController::class,'changeStatus'])->name('category.change-status');
    Route::put('/change-business-category-status',[CategoryController::class,'changeBusinessCategoryStatus'])->name('businessCategory.change-status');
    Route::get('/categoryList', [CategoryController::class, 'fetchTableData'])->name('categoryList');
    Route::get('/business-category/{id}/edit', [CategoryController::class, 'businessCategoryEdit'])->name('businessCategoryEdit');
    Route::put('/category/update', [CategoryController::class, 'update'])->name('maincategoryUpdate');
    Route::delete('/category/delete', [CategoryController::class, 'destroy'])->name('categoryDelete');
    Route::post('/search-category', [CategoryController::class,'searchCategory'])->name('ajaxSearchCategory');
    Route::post('/ajax-search-subcategory', [CategoryController::class, 'ajaxSearchSubcategory'])->name('ajaxSearchSubcategory');

    Route::post('/get-category', [EventsCategoryController::class, 'eventCategory'])->name('admin.getEventCategory');
    
    //Sub category
    Route::resource('/subcategory', SubCategoryController::class)->names([
        'index' => 'adminSubcategory', // Correctly defining the index route name
    ]);
    // Route::resource('subcategory', SubCategoryController::class);
    Route::put('/change-subcategory-status',[SubCategoryController::class,'changeStatus'])->name('subcategory.change-status');
    Route::get('/subcategoryList', [SubCategoryController::class, 'fetchTableData'])->name('subcategoryList');
    Route::put('/subcategory/update', [SubCategoryController::class, 'update'])->name('subcategoryUpdate');
    Route::delete('/subcategory/delete', [SubCategoryController::class, 'destroy'])->name('subcategoryDelete');

    // Event category
    Route::get('/event-category', [EventsCategoryController::class, 'index'])->name('eventsCategory.index');
    Route::get('/event-fetch-category', [EventsCategoryController::class, 'fetchTableData'])->name('eventCategoryList');
    Route::post('/process-event-category', [EventsCategoryController::class, 'store'])->name('eventCategory.store');
    Route::get('/event-category/{id}/edit', [EventsCategoryController::class, 'edit'])->name('eventCategoryEdit');
    Route::put('/event-update', [EventsCategoryController::class, 'update'])->name('eventCategoryUpdate');
    Route::delete('/event-delete', [EventsCategoryController::class, 'destroy'])->name('eventCategoryDelete');
    Route::put('/change-status', [EventsCategoryController::class,'changeStatus'])->name('change-status');

    // Event Ticket category 
    Route::get('/event-ticket-category', [TicketCategoryController ::class, 'index'])->name('eventTicketCategory.index');
    Route::get('/event-ticket-fetch-category', [TicketCategoryController ::class, 'fetchTableData'])->name('eventTicketCategoryList');
    Route::post('/process-event-ticket-category', [TicketCategoryController ::class, 'Store'])->name('eventTicketCategory.store');
    Route::get('/event/ticket-category/{id}/edit', [TicketCategoryController::class, 'edit'])->name('eventTicketCategoryEdit');
    Route::put('/event-ticket-update', [TicketCategoryController ::class, 'update'])->name('eventTicketCategoryUpdate');
    Route::delete('/event-ticket-delete', [TicketCategoryController ::class, 'destroy'])->name('eventTicketCategoryDelete'); 
    Route::post('/search-event-ticket-category', [TicketCategoryController ::class,'searchCategory'])->name('ajaxSearchEventTicketCategory');

    Route::put('/change-event-ticket-category-status',[TicketCategoryController ::class,'changeStatus'])->name('category.change-status');

    // AdPost  

    Route::get('/adPost', [AdPostController::class, 'index'])->name('adPost.listing');
    Route::get('/viewPost/{id}', [AdPostController::class, 'viewPost'])->name('viewPost');
    Route::put('/change-review-status', [AdPostController::class, 'changeReviewStatus'])->name('review.change_status');
    Route::get('/adPostList', [AdPostController::class, 'fetchTableData'])->name('adPostList');


    // Route::put('change-expirystatus', [AdPostController::class, 'changeExpiryStatus'])->name('post.change-expiry-status');
    Route::put('/change-feature',[AdPostController::class,'changeFeature'])->name('post.change-feature');
    Route::put('/change-recommend',[AdPostController::class,'changeRecommend'])->name('post.change-recommend');
    Route::put('/change-urgent',[AdPostController::class,'changeUrgent'])->name('post.change-urgent');
    Route::put('/update-post-status', [AdPostController::class, 'changeStatus'])->name('post.change-status');
    Route::put('/change-spotlight',[AdPostController::class,'changeSpotlight'])->name('post.change-spotlight');
    Route::delete('/adPost/delete', [AdPostController::class, 'destroy'])->name('ad-post.delete');
    
    // Business  
    Route::get('/business/request', [BusinessController::class, 'index'])->name('businessRequest');
    Route::get('/process-request', [BusinessController::class, 'fetchTableData'])->name('RequestList');
    Route::put('/business-change-status', [BusinessController::class, 'changeBusinessStatus'])->name('business.change-status');
    Route::put('/business-change-feature', [BusinessController::class, 'changeBusinessFeature'])->name('business.change-feature');
    Route::delete('/business/delete', [BusinessController::class, 'destroyBusiness'])->name('business.delete');
    Route::get('/process-business-product', [BusinessController::class, 'fetchBusinessProductData'])->name('businessProductList');
    Route::get('/add-business-product/{id}', [BusinessController::class, 'addProduct'])->name('addBusinessProduct');
    Route::get('/business-product-list/{id}', [BusinessController::class, 'listProduct'])->name('listBusinessProduct');
    Route::post('/business-product-delete-image', [BusinessController::class, 'deleteproductImage']);

    Route::post('/process-product', [BusinessController::class, 'storeProduct'])->name('business.products.store');
    Route::delete('/product/delete', [BusinessController::class, 'destroyProduct'])->name('business-product.delete');

    // Route to render the business enquiries page
    Route::get('/business/enquiries', [BusinessController::class, 'enquiries'])->name('admin.business.enquiries');
    Route::get('/business-products/enquiries', [BusinessController::class, 'business_product_enquiries'])->name('admin.business.products_enquiries');
    // Route to handle the AJAX request to fetch business enquiries
    Route::get('/business/ajax-enquiries', [BusinessController::class, 'getBusinessEnquiries'])->name('admin.ajax.business.enquiries');

    // Route to handle the AJAX request to delete an enquiry
    Route::delete('/business/enquiries/{id}', [BusinessController::class, 'deleteEnquiry'])->name('admin.business.enquiry.delete');

    Route::get('/add-business', [BusinessController::class, 'addBusiness'])->name('addBusinessByAdmin');
    Route::post('/process-business', [BusinessController::class, 'storeBusiness'])->name('business.store');
    Route::get('/business/created-by-admin', [BusinessController::class, 'businessByAdmin'])->name('businessByAdmin');
    Route::get('/business/process-request', [BusinessController::class, 'fetchBusinessData'])->name('businessList');
    
    Route::get('/product/list', [BusinessController::class, 'allProducts'])->name('admin.allProducts');
    Route::get('/product/fetch-product', [BusinessController::class, 'fetchAllProductsData'])->name('admin.fetchProductList');
    Route::get('/edit-product/{id}', [BusinessController::class, 'editProduct'])->name('editProductData');
    
    Route::put('/product-change-status', [BusinessController::class, 'changeProductStatus'])->name('product.changeStatus');
    Route::put('/product-change-feature', [BusinessController::class, 'changeProductFeature'])->name('product.changeFeature');
    Route::get('/product-list-by-business/{id}', [BusinessController::class, 'fetchBusinessProductData'])->name('businessProductListByid');
    Route::get('/edit-business/{id}', [BusinessController::class, 'editBusiness'])->name('editBusinessData');
    Route::post('/business-update/{id}', [BusinessController::class, 'updateBusiness'])->name('business.update');
    Route::delete('/delete-business-image/{id}', [BusinessController::class, 'deleteImage']);
    Route::get('/view-business/{id}', [BusinessController::class, 'viewBusiness'])->name('viewBusiness');
    Route::get('/edit-business-product/{bid}/{id}', [BusinessController::class, 'editBusinessProduct'])->name('editBusinessProductData');
    Route::post('/product-update/{id}', [BusinessController::class, 'updateProduct'])->name('business.products.update');
    Route::post('/product-variant-update/{id}', [BusinessController::class, 'updateVariant'])->name('business.products.variant.update');
    ROute::get('/updateBusinessRecords',[BusinessController::class, 'updateUserBusinessInfos']);
    
    // Ngo Category
    Route::get('/ngo-categories', [NgoCategoryController::class, 'index'])->name('ngoCategory');
    Route::get('/get-ngo-categories', [NgoCategoryController::class, 'fetchTableData'])->name('get.ngo.categories');
    Route::post('/ngo-categories', [NgoCategoryController::class, 'store'])->name('ngoCategory.create');
    Route::get('/ngo-edit/{id}', [NgoCategoryController::class, 'editNgoCategory'])->name('editNgoCategoryData');
    Route::put('/bngo-category-update', [NgoCategoryController::class, 'update'])->name('ngoCategoryUpdate');
    Route::put('/ngo-category-change-status', [NgoCategoryController::class, 'changeNgoCategoryStatus'])->name('ngo.change-category-status');
    Route::delete('/ngo-category/delete', [NgoCategoryController::class, 'destroy'])->name('ngo.categoryDelete');
    
    // NGO
    Route::get('/ngo/created-by-admin', [NgoController::class, 'ngoByAdmin'])->name('ngoByAdmin');
    Route::get('/ngo/process-request', [NgoController::class, 'fetchNgoData'])->name('ngoList');
    Route::get('/ngo', [NgoController::class, 'addNgo'])->name('addNgoByAdmin');
    Route::post('/process-ngo', [NgoController::class, 'storeNgo'])->name('ngo.store');
    Route::put('/ngo-change-status', [NgoController::class, 'changeNgoStatus'])->name('ngo.change-status');
    Route::put('/ngo-change-feature', [NgoController::class, 'changeNgoFeature'])->name('ngo.change-feature');
    Route::get('/edit-ngo/{id}', [NgoController::class, 'editNgo'])->name('editNgoData');
    Route::post('/ngo-update/{id}', [NgoController::class, 'updateNgo'])->name('ngo.update');
    Route::get('/view-ngo/{id}', [NgoController::class, 'viewNgo'])->name('showNgoData');
    Route::post('/search-ngo-category', [NgoController::class,'searchCategory'])->name('ajaxSearchNgoCategory');
    Route::delete('/ngo/delete', [NgoController::class, 'destroyNgo'])->name('ngo.delete');
    Route::post('/ngo-delete-image', [NgoController::class, 'deletengoImage'])->name('ngo.delete.image');

    
    Route::get('/ngo/request', [NgoController::class, 'ngoRequest'])->name('ngoRequest');
    Route::get('/ngo/process-requests', [NgoController::class, 'fetchTableData'])->name('NgoRequestList');
    Route::put('/change-ngo-status', [NgoController::class, 'changeNgosStatus'])->name('change.ngo-status');


    // NGO Members
    Route::get('/ngo-members/{id}', [NgoMemberController::class, 'index'])->name('admin.addNgoMember');
    Route::get('/ngo-members/{id}/list', [NgoMemberController::class, 'fetchMemberData'])->name('ngoMemberList');
    Route::post('/process-ngo-member', [NgoMemberController::class, 'memberStoreNgo'])->name('ngo.member.store');
    Route::get('/edit-member/{id}', [NgoMemberController::class, 'editMember'])->name('editMemberData');
    Route::post('/ngo-member-update/{id}', [NgoMemberController::class, 'updateMember'])->name('ngo_member.update');
    Route::delete('/ngo-member/delete', [NgoMemberController::class, 'destroyNgoMember'])->name('member.delete');
    

    //fundraising 
    Route::get('/fundraising', [FundraisingController::class, 'index'])->name('adminFundraising');
    Route::get('/FundraisingList', [FundraisingController::class, 'fetchFundraisingData'])->name('adminFundraisingsList');
    Route::put('/fundraising/status/change', [FundraisingController::class, 'changeFundraisingsStatus'])->name('fundraisingChangeStatus');
    Route::put('/admin/fundraising/change-featured', [FundraisingController::class, 'changeFundraisingFeatured'])->name('fundraisingChangeFeatured');
    Route::delete('/admin/fundraising/delete-by-slug', [FundraisingController::class, 'destroyBySlug'])->name('fundraisingDestroyBySlug');
    Route::get('/fundraising/{fundraising}', [FundraisingController::class, 'show'])->name('adminfundraisingShow');
    Route::get('/donation/{fundraising}', [FundraisingController::class, 'Donation'])->name('adminDonationShow');
    Route::get('/donation-list', [FundraisingController::class, 'fetchDonationgData'])->name('adminDonationList');

    Route::prefix('donation-packages')->group(function() {
        Route::get('/', [DonationPackageController::class, 'index'])->name('adminDonationPackages');
        Route::get('fetch-data', [DonationPackageController::class, 'fetchTableData'])->name('adminDonationPackagesList');
        Route::get('/add', [DonationPackageController::class, 'create'])->name('adminDonationPackageCreate');
        Route::post('/store', [DonationPackageController::class, 'store'])->name('adminDonationPackageStore');
        Route::get('{id}', [DonationPackageController::class, 'show'])->name('adminDonationPackageShow');
        Route::put('{id}', [DonationPackageController::class, 'update']);
        Route::put('change-featured', [DonationPackageController::class, 'changeFeatured'])->name('donationChangeFeatured');
        Route::put('status/change', [DonationPackageController::class, 'changeStatus'])->name('donationPackageChangeStatus');
        Route::delete('delete/{id}', [DonationPackageController::class, 'destroy'])->name('donationPackageDestroy');
    });

    Route::get('/donation-payment-listing', [DonationPackageController::class, 'listingData'])->name('adminDonationPackagesListing');
        Route::get('/fetch-listing-data', [DonationPackageController::class, 'fetchTableListingData'])->name('adminDonationPaymentList');

    //  faq category 
    Route::get('/faq-categories', [FaqCategoryController::class, 'index'])->name('faqCategory');

    Route::post('/faq-categories', [FaqCategoryController::class, 'store'])->name('faqCategory.create');
    Route::get('/faq-fetch-category', [FaqCategoryController::class, 'fetchTableData'])->name('faqCategoryList');

    Route::put('/change-faqcategory-status', [FaqCategoryController::class, 'changeStatus'])->name('faqcategorychange-status');

    //  faq sybcategory 
    Route::get('/faq-subcategories', [FaqSubcategoryController::class, 'index'])->name('faqSubcategory');

    Route::post('/faq-subcategories', [FaqSubcategoryController::class, 'store'])->name('faqSubcategory.create');
    Route::get('/faq-fetch-subcategory', [FaqSubcategoryController::class, 'fetchTableData'])->name('faqSubcategoryList');



    // faqs 
    Route::get('/faqs-listing', [FaqController::class, 'index'])->name('faqList');
    Route::get('/faqs-fetch', [FaqController::class, 'fetchTableData'])->name('faq.fetchData');

    Route::get('/add-faqs', [FaqController::class, 'add'])->name('faqAdd');
    Route::get('/get-subcategories', [FaqController::class, 'getSubcategories'])->name('getSubcategories');
    Route::post('/faqs/store', [FaqController::class, 'store'])->name('faqs.store');
    Route::post('/upload-image', [FaqController::class, 'uploadImage'])->name('uploadImage');

    Route::get('/faqs-edit/{slug}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/faqs-update/{slug}', [FaqController::class, 'update'])->name('faq.update');
    Route::get('/faq/{slug}', [FaqController::class, 'show'])->name('faq.show');




    // Event
    Route::get('/events', [EventController::class, 'index'])->name('adminEvents');

    // Route for fetching event table data
    Route::get('/EventList', [EventController::class, 'fetchTableData'])->name('adminEventsList');

    Route::get('/add-events', [EventController::class, 'add'])->name('adminEventsAdd');

    Route::post('/events/create', [EventController::class, 'store'])->name('adminEventsCreate');

    // Tickets 
    Route::get('/events/tickets', [EventController::class, 'tickets'])->name('admin.event.tickets');
    Route::get('/events/ajax-tickets', [EventController::class, 'getEventTickets'])->name('admin.ajax.event.tickets');
    // Route to render the event enquiries page
    Route::get('/events/enquiries', [EventController::class, 'enquiries'])->name('admin.event.enquiries');

    // Route to handle the AJAX request to fetch event enquiries
    Route::get('/events/ajax-enquiries', [EventController::class, 'getEventEnquiries'])->name('admin.ajax.event.enquiries');

    // Route to handle the AJAX request to delete an enquiry
    Route::delete('/events/enquiries/{id}', [EventController::class, 'deleteEnquiry'])->name('admin.event.enquiry.delete');


    // Route to render the event reports page
    Route::get('/events/reports', [EventController::class, 'reports'])->name('admin.event.reports');

    // Route to handle the AJAX request to fetch event reports
    Route::get('/events/ajax-reports', [EventController::class, 'getEventReports'])->name('admin.ajax.event.reports');

    // Route to handle the AJAX request to delete a report
    Route::delete('/events/reports/{id}', [EventController::class, 'deleteReports'])->name('admin.event.report.delete');

    Route::get('/events/{event}', [EventController::class, 'show'])->name('adminEventsShow');

    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('adminEventsEdit');

    Route::put('/events/{event}/update', [EventController::class, 'update'])->name('adminEventsUpdate');

    Route::put('/events/status/change', [EventController::class, 'changeEventsStatus'])->name('eventsChangeStatus');

    Route::put('/events/feature/change', [EventController::class, 'changeFeatureStatus'])->name('eventsChangeFeature');

    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('adminEventsDestroy');
    
    


    // orders 
    Route::get('/orders/ticketorders', [OrderController::class, 'orderticket'])->name('orderticket');
    Route::get('/ticketorderlist', [OrderController::class, 'fetchTableData'])->name('adminticketorderList');
    // Route for viewing order details
    Route::get('/orders/ticket/{id}', [OrderController::class, 'viewOrder'])->name('viewOrder');

    // Route for PDF download order Product Invoice
    Route::get('/order/print/{id}', [OrderController::class, 'printInvoice'])->name('orderitem.print');
    Route::get('/order/pdf/{id}', [OrderController::class, 'downloadPDF'])->name('orderitem.download.pdf');


    Route::get('/orders/itemorders', [OrderController::class, 'orderitem'])->name('orderitem');
    Route::get('/orders/itemorders/data', [OrderController::class, 'fetchOrderItemsData'])->name('orderitems.data');
    Route::get('/order/itemorders/{id}', [OrderController::class, 'vieworderitem'])->name('orderitem.view');
    Route::post('/order-item/update-status', [OrderController::class, 'updateStatus'])->name('updateorderItemStatus');
    Route::delete('/order-item/delete', [OrderController::class, 'destroy'])->name('orderItemDelete');



    //User
    Route::get('/users', [UserController::class, 'index'])->name('user.listing');
    Route::get('/users-list', [UserController::class, 'fetchTableData'])->name('userList');
    Route::delete('/users/delete/', [UserController::class, 'destroy'])->name('user.delete');
    Route::get('/viewUser/{id}', [UserController::class, 'viewUser'])->name('viewUser');
    Route::post('/search-user', [UserController::class,'searchUser'])->name('ajaxSearchUser');
    Route::post('/update-user-status', [UserController::class, 'updateUserStatus'])->name('update.user.status');
    Route::get('/deleted-users', [UserController::class, 'deletedUser'])->name('deleted.userListing');
    Route::get('/deleted-users-list', [UserController::class, 'fetchDeletedUserData'])->name('userDeletedList');
    Route::post('/update-user-restore', [UserController::class, 'updateUserRestore'])->name('update.user.restore');
    Route::post('/update-admin-approved', [UserController::class, 'updateAdminApproved'])->name('update.admin.approved');
    Route::post('/update-module-visible', [UserController::class, 'updateModuleVisible'])->name('update.admin.module');

    //conatc us form
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/admin/newsletters', [NewsletterController::class, 'index'])->name('admin.newsletters');

    // admin announcement
    Route::get('/admin/announcement', [AdminController::class, 'announcement'])->name('adminAnnouncement');
    Route::get('/announcementList', [AdminController::class, 'fetchTableData'])->name('adminAnnouncementList');
    Route::get('/admin/adminMessage', [AdminController::class, 'message'])->name('adminAddAnnouncement');
    Route::post('/message/create', [AdminController::class, 'storeMessage'])->name('adminAnnouncementCreate');
    Route::delete('/announcement/{id}', [AdminController::class, 'destroyAnnouncement'])->name('announcementDestroy');


    //posts reviews 
    Route::get('/reviews', [ReviewController::class, 'index'])->name('review');
    Route::put('/change-review-status', [ReviewController::class, 'changeReviewStatus'])->name('review.change_status');
    Route::delete('/delete-review', [ReviewController::class, 'destroy'])->name('review.destroy');


    //blogs 
    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.list');

    Route::get('/add-blog', [BlogsController::class, 'addblog'])->name('adminBlogAdd');
    Route::post('/blog/create', [BlogsController::class, 'store'])->name('adminBlogStore');
    Route::get('/blog/edit/{id}', [BlogsController::class, 'edit'])->name('adminBlogEdit');
    Route::put('/blog/{id}', [BlogsController::class, 'update'])->name('adminBlogUpdate');
    Route::delete('/blog/{id}', [BlogsController::class, 'destroy'])->name('blog.delete');



    // fundraising category 

    Route::get('/fundraising-category', [FundraisingCategoryController::class, 'index'])->name('fundarasingCategory.index');
    Route::get('/fundraising-fetch-category', [FundraisingCategoryController::class, 'fetchTableData'])->name('fundarasingCategoryList');
    Route::post('/process-fundraising-category', [FundraisingCategoryController::class, 'store'])->name('fundraisingCategory.store');

    Route::get('/fundraising-category/{id}/edit', [FundraisingCategoryController::class, 'edit'])->name('fundarasingCategoryEdit');
    Route::put('/fundraising-update', [FundraisingCategoryController::class, 'update'])->name('fundarasingCategoryUpdate');
    Route::delete('/fundraising-delete', [FundraisingCategoryController::class, 'destroy'])->name('fundarasingCategoryDelete');

    Route::put('/change-status', [FundraisingCategoryController::class,'changeStatus'])->name('change-status');

    

    // jobs 
    Route::get('/jobs-listing', [JobsController::class, 'index'])->name('jobsList');
    Route::get('/fetch-jobs-data', [JobsController::class, 'fetchJobsData'])->name('fetchJobsData');
    Route::post('/add-job', [JobsController::class, 'store'])->name('job.store');
    Route::get('/job/{id}/edit', [JobsController::class, 'edit'])->name('JobEdit');
    Route::put('/job-update/{id}', [JobsController::class, 'update'])->name('job.update');
    Route::post('/search-jobs-category', [JobsController::class,'searchCategory'])->name('ajaxSearchJobsCategory');
    Route::post('/jobs/update-status/{id}', [JobsController::class, 'updateStatus'])->name('updateJobStatus');
    Route::get('/jobs/{slug}', [JobsController::class, 'show'])->name('jobs.show');
    Route::get('/download-resume/{file}', [JobsController::class, 'downloadResume'])->name('admin.downloadResume');
    Route::put('/job-change-status', [JobsController::class, 'changeJobStatus'])->name('jobs.change-status');
    Route::delete('/job-delete', [JobsController::class, 'destroy'])->name('admin.jobDelete');

    // jobs Category
    Route::get('/jobs-category', [JobsCategoryController::class, 'index'])->name('jobsCategoryList');
    Route::get('/fetch-jobs-category-data', [JobsCategoryController::class, 'fetchJobsCategoryData'])->name('fetchJobsCategoryData');
    Route::post('/job-category/store', [JobsCategoryController::class, 'store'])->name('storeJobCategory');
    Route::get('/edit-job-category/{id}', [JobsCategoryController::class, 'edit'])->name('editJobCategoryData');
    Route::put('/update-jobcategory', [JobsCategoryController::class, 'update'])->name('jobCategoryUpdate');
    Route::put('/job-category/update-status', [JobsCategoryController::class, 'updateStatus'])->name('updateJobCategoryStatus');
    Route::delete('/job-category', [JobsCategoryController::class, 'destroy'])->name('jobCategoryDelete');

    // Professionals
    Route::get('/professionals-listing', [ProfessionalController::class, 'index'])->name('professionalsList');
    Route::get('/fetch-professionals-data', [ProfessionalController::class, 'fetchTableData'])->name('fetchProfessionalssData');
    Route::get('/add-professional', [ProfessionalController::class, 'add'])->name('adminProfessionalsAdd');
    Route::post('/store-professional', [ProfessionalController::class, 'storeProfessional'])->name('adminStoreProfessionals');
    Route::get('/edit-professional/{id}', [ProfessionalController::class, 'editProfessional'])->name('editProfessionalData');
    Route::put('/edit-professional/{id}', [ProfessionalController::class, 'updateProfessional'])->name('updateProfessionalData');
    Route::post('/professionals/update-status', [ProfessionalController::class, 'updateStatus'])->name('changeProfessionalsStatus');
    Route::get('/professionals/{id}', [ProfessionalController::class, 'show'])->name('professionals.show');
    Route::delete('/professionals/{id}', [ProfessionalController::class, 'destroy'])->name('adminprofessionalDestroy');

    // Skill
    Route::get('/skill', [SkillController::class, 'index'])->name('skillList');
    Route::get('/fetch-skill', [SkillController::class, 'fetchTableData'])->name('fetchSkillList');
    Route::post('/skill/store', [SkillController::class, 'store'])->name('storeSkill');
    Route::get('/skill/{id}/edit', [SkillController::class, 'skillEdit'])->name('skillEdit');
    Route::get('/search-skills', [SkillController::class,'getSkills'])->name('ajaxSearchSkills');
    Route::put('/skill/update', [SkillController::class, 'skillUpdate'])->name('skillUpdate');
    Route::put('/change-skill-status',[SkillController::class,'changeSkillStatus'])->name('skill.change-status');
    Route::delete('/skill/delete', [SkillController::class, 'destroy'])->name('skillDelete');

    // Attributes
    Route::get('/attribute', [AttributesController::class, 'index'])->name('attributeList');
    Route::get('/fetch-attribute', [AttributesController::class, 'fetchTableData'])->name('fetchAttributeList');
    Route::post('/attribute/store', [AttributesController::class, 'store'])->name('storeAttribute');
    Route::get('/attribute/{id}/edit', [AttributesController::class, 'attributeEdit'])->name('attributeEdit');
    Route::get('/search-attribute', [AttributesController::class,'getAttribute'])->name('ajaxSearchAttribute');
    Route::put('/attribute/update', [AttributesController::class, 'attributeUpdate'])->name('attributeUpdate');
    Route::put('/change-attribute-status',[AttributesController::class,'changeAttributeStatus'])->name('attribute.change-status');
    Route::delete('/attribute/delete', [AttributesController::class, 'destroy'])->name('attributeDelete');
});
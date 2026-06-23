<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\WebmasterLicenseController;
use App\Http\Controllers\Dashboard\WebmasterSettingsController;
use App\Http\Controllers\Dashboard\WebmasterBannersController;
use App\Http\Controllers\Dashboard\WebmasterSectionsController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\BannersController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\TopicsController;
use App\Http\Controllers\Dashboard\ContactsController;
use App\Http\Controllers\Dashboard\WebmailsController;
use App\Http\Controllers\Dashboard\EventsController;
use App\Http\Controllers\Dashboard\AnalyticsController;
use App\Http\Controllers\Dashboard\MenusController;
use App\Http\Controllers\Dashboard\FileManagerController;
use App\Http\Controllers\Dashboard\TagController;
use App\Http\Controllers\Dashboard\PopupController;
use App\Http\Controllers\Dashboard\LeaguecrmController;
use App\Http\Controllers\Dashboard\KycController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\TournamentController;
use App\Http\Controllers\AdminTeamController;
use Illuminate\Support\Facades\Route;

// Admin Home
Route::get('/', [DashboardController::class, 'index'])->name('adminHome');
//Search
Route::get('/search', [DashboardController::class, 'search'])->name('adminSearch');

// Webmaster
Route::get('/webmaster', [WebmasterSettingsController::class, 'edit'])->name('webmasterSettings');
Route::get('/webmaster-save/{tab?}', [WebmasterSettingsController::class, 'saved'])->name('webmasterSettingsSaved');
Route::post('/webmaster', [WebmasterSettingsController::class, 'update'])->name('webmasterSettingsUpdate');
Route::post('/webmaster/languages/store', [WebmasterSettingsController::class, 'language_store'])->name('webmasterLanguageStore');
Route::post('/webmaster/languages/store', [WebmasterSettingsController::class, 'language_store'])->name('webmasterLanguageStore');
Route::post('/webmaster/languages/update', [WebmasterSettingsController::class, 'language_update'])->name('webmasterLanguageUpdate');
Route::get('/webmaster/languages/destroy/{id}', [WebmasterSettingsController::class, 'language_destroy'])->name('webmasterLanguageDestroy');
Route::get('/webmaster/seo/repair', [WebmasterSettingsController::class, 'seo_repair'])->name('webmasterSEORepair');

Route::post('/webmaster/mail/smtp', [WebmasterSettingsController::class, 'mail_smtp_check'])->name('mailSMTPCheck');
Route::post('/webmaster/mail/test', [WebmasterSettingsController::class, 'mail_test'])->name('mailTest');


Route::post('/webmaster-license', [WebmasterLicenseController::class, 'index'])->name('licenseCheck');

// Webmaster Sections
Route::get('/modules', [WebmasterSectionsController::class, 'index'])->name('WebmasterSections');
Route::get('/modules/create', [WebmasterSectionsController::class, 'create'])->name('WebmasterSectionsCreate');
Route::post('/modules/store', [WebmasterSectionsController::class, 'store'])->name('WebmasterSectionsStore');
Route::get('/modules/{id}/edit', [WebmasterSectionsController::class, 'edit'])->name('WebmasterSectionsEdit');
Route::post('/modules/{id}/update',
    [WebmasterSectionsController::class, 'update'])->name('WebmasterSectionsUpdate');

Route::post('/modules/{id}/seo', [WebmasterSectionsController::class, 'seo'])->name('WebmasterSectionsSEOUpdate');

Route::get('/modules/destroy/{id}',
    [WebmasterSectionsController::class, 'destroy'])->name('WebmasterSectionsDestroy');
Route::post('/modules/updateAll',
    [WebmasterSectionsController::class, 'updateAll'])->name('WebmasterSectionsUpdateAll');

// Webmaster Sections :Custom Fields
Route::get('/modules/{webmasterId}/fields', [WebmasterSectionsController::class, 'webmasterFields'])->name('webmasterFields');
Route::get('/{webmasterId}/fields/create', [WebmasterSectionsController::class, 'fieldsCreate'])->name('webmasterFieldsCreate');
Route::post('/modules/{webmasterId}/fields/store', [WebmasterSectionsController::class, 'fieldsStore'])->name('webmasterFieldsStore');
Route::get('/modules/{webmasterId}/fields/{field_id}/edit', [WebmasterSectionsController::class, 'fieldsEdit'])->name('webmasterFieldsEdit');
Route::post('/modules/{webmasterId}/fields/{field_id}/update', [WebmasterSectionsController::class, 'fieldsUpdate'])->name('webmasterFieldsUpdate');
Route::get('/modules/{webmasterId}/fields/destroy/{field_id}', [WebmasterSectionsController::class, 'fieldsDestroy'])->name('webmasterFieldsDestroy');
Route::post('/modules/{webmasterId}/fields/updateAll', [WebmasterSectionsController::class, 'fieldsUpdateAll'])->name('webmasterFieldsUpdateAll');

// Settings
Route::get('/settings', [SettingsController::class, 'edit'])->name('settings');
Route::post('/settings', [SettingsController::class, 'updateSiteInfo'])->name('settingsUpdateSiteInfo');

// Ad. Banners
Route::get('/banners', [BannersController::class, 'index'])->name('Banners');
Route::get('/banners/create/{sectionId}', [BannersController::class, 'create'])->name('BannersCreate');
Route::post('/banners/store', [BannersController::class, 'store'])->name('BannersStore');
Route::get('/banners/{id}/edit', [BannersController::class, 'edit'])->name('BannersEdit');
Route::post('/banners/{id}/update', [BannersController::class, 'update'])->name('BannersUpdate');
Route::get('/banners/destroy/{id?}', [BannersController::class, 'destroy'])->name('BannersDestroy');
Route::post('/banners/updateAll', [BannersController::class, 'updateAll'])->name('BannersUpdateAll');

// Webmaster Banners
Route::get('/banners-settings', [WebmasterBannersController::class, 'index'])->name('WebmasterBanners');
Route::get('/banners-settings/create', [WebmasterBannersController::class, 'create'])->name('WebmasterBannersCreate');
Route::post('/banners-settings/store', [WebmasterBannersController::class, 'store'])->name('WebmasterBannersStore');
Route::get('/banners-settings/{id}/edit', [WebmasterBannersController::class, 'edit'])->name('WebmasterBannersEdit');
Route::post('/banners-settings/{id}/update', [WebmasterBannersController::class, 'update'])->name('WebmasterBannersUpdate');
Route::get('/banners-settings/destroy/{id}', [WebmasterBannersController::class, 'destroy'])->name('WebmasterBannersDestroy');
Route::post('/banners-settings/updateAll', [WebmasterBannersController::class, 'updateAll'])->name('WebmasterBannersUpdateAll');


// bookings

Route::get('/bookinglist', [ClientController::class, 'bookingList'])->name('bookingList');
Route::get('/bookingview/{id}', [ClientController::class, 'bookingview'])->name('bookingview');
Route::get('/corporateList', [ClientController::class, 'corporateList'])->name('corporateList');
Route::get('/corporateview/{id}', [ClientController::class, 'corporateview'])->name('corporateview');
Route::get('/membershipList', [ClientController::class, 'membershipList'])->name('membershipList');
Route::get('/membershipView/{id}', [ClientController::class, 'membershipView'])->name('membershipView');

Route::get('/listtems', [ClientController::class, 'listtems'])->name('listtems');
Route::post('/temssave', [ClientController::class, 'temssave'])->name('temssave');
Route::get('/teamdetails/{id}', [ClientController::class, 'teamdetails'])->name('teamdetails');


Route::get('/tems', [AdminTeamController::class, 'index'])->name('teams.index');
Route::post('/teams/store', [AdminTeamController::class, 'store'])->name('teams.store');
Route::get('/viewteam/{id}', [AdminTeamController::class, 'viewteam'])->name('viewteam');


// travels

Route::post('/teams/travel', [AdminTeamController::class, 'travel'])->name('teams.travel');
Route::get('/viewtravel/{id}', [AdminTeamController::class, 'viewtravel'])->name('viewtravel');
Route::get('/listtravel', [ClientController::class, 'listtravel'])->name('listtravel');

Route::get('/traveldetails/{id}', [ClientController::class, 'traveldetails'])->name('traveldetails');

// network
Route::post('/teams/network', [AdminTeamController::class, 'network'])->name('teams.network');
Route::get('/viewnetwork/{id}', [AdminTeamController::class, 'viewnetwork'])->name('viewnetwork');
Route::get('/listnetwork', [ClientController::class, 'listnetwork'])->name('listnetwork');
Route::get('/networkdetails/{id}', [ClientController::class, 'networkdetails'])->name('networkdetails');

// Sections
Route::get('/{webmasterId}/categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('/{webmasterId}/categories/create', [CategoriesController::class, 'create'])->name('categoriesCreate');
Route::post('/{webmasterId}/categories/store', [CategoriesController::class, 'store'])->name('categoriesStore');
Route::get('/{webmasterId}/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categoriesEdit');
Route::get('/{webmasterId}/categories/{id}/clone', [CategoriesController::class, 'clone'])->name('categoriesClone');
Route::post('/{webmasterId}/categories/{id}/update', [CategoriesController::class, 'update'])->name('categoriesUpdate');
Route::post('/{webmasterId}/categories/{id}/seo', [CategoriesController::class, 'seo'])->name('categoriesSEOUpdate');
Route::get('/{webmasterId}/categories/destroy/{id?}', [CategoriesController::class, 'destroy'])->name('categoriesDestroy');
Route::post('/{webmasterId}/categories/updateAll', [CategoriesController::class, 'updateAll'])->name('categoriesUpdateAll');

// Topics
Route::get('/{webmasterId}/topics', [TopicsController::class, 'index'])->name('topics');
Route::post('/topics-list', [TopicsController::class, 'list'])->name('topicsList');
Route::get('/{webmasterId}/view/{id}', [TopicsController::class, 'view'])->name('topicView');
Route::get('/{webmasterId}/topics/create', [TopicsController::class, 'create'])->name('topicsCreate');
Route::post('/{webmasterId}/topics/store', [TopicsController::class, 'store'])->name('topicsStore');
Route::get('/{webmasterId}/topics/{id}/edit', [TopicsController::class, 'edit'])->name('topicsEdit');
Route::get('/{webmasterId}/topics/{id}/clone', [TopicsController::class, 'clone'])->name('topicsClone');
Route::post('/{webmasterId}/topics/{id}/update', [TopicsController::class, 'update'])->name('topicsUpdate');
Route::get('/{webmasterId}/topics/destroy/{id?}', [TopicsController::class, 'destroy'])->name('topicsDestroy');
Route::post('/{webmasterId}/topics/updateAll', [TopicsController::class, 'updateAll'])->name('topicsUpdateAll');
Route::get('/{webmasterId}/print', [TopicsController::class, 'print'])->name('topicsPrint');
// Topics :SEO
Route::post('/{webmasterId}/topics/{id}/seo', [TopicsController::class, 'seo'])->name('topicsSEOUpdate');
// Topics :Photos
Route::post('/topics/upload', [TopicsController::class, 'upload'])->name('topicsPhotosUpload');
Route::post('/{webmasterId}/topics/{id}/photos', [TopicsController::class, 'photos'])->name('topicsPhotosEdit');
Route::get('/{webmasterId}/topics/{id}/photos/{photo_id}/destroy',
    [TopicsController::class, 'photosDestroy'])->name('topicsPhotosDestroy');
Route::post('/{webmasterId}/topics/{id}/photos/updateAll',
    [TopicsController::class, 'photosUpdateAll'])->name('topicsPhotosUpdateAll');


Route::post('/topics-import', [TopicsController::class, 'import'])->name('topicsImport');


// Topics :Files
Route::get('/{webmasterId}/topics/{id}/files', [TopicsController::class, 'topicsFiles'])->name('topicsFiles');
Route::get('/{webmasterId}/topics/{id}/files/create',
    [TopicsController::class, 'filesCreate'])->name('topicsFilesCreate');
Route::post('/{webmasterId}/topics/{id}/files/store',
    [TopicsController::class, 'filesStore'])->name('topicsFilesStore');
Route::get('/{webmasterId}/topics/{id}/files/{file_id}/edit',
    [TopicsController::class, 'filesEdit'])->name('topicsFilesEdit');
Route::post('/{webmasterId}/topics/{id}/files/{file_id}/update',
    [TopicsController::class, 'filesUpdate'])->name('topicsFilesUpdate');
Route::get('/{webmasterId}/topics/{id}/files/destroy/{file_id}',
    [TopicsController::class, 'filesDestroy'])->name('topicsFilesDestroy');
Route::post('/{webmasterId}/topics/{id}/files/updateAll',
    [TopicsController::class, 'filesUpdateAll'])->name('topicsFilesUpdateAll');


// Topics :Related
Route::get('/{webmasterId}/topics/{id}/related', [TopicsController::class, 'topicsRelated'])->name('topicsRelated');
Route::get('/relatedLoad/{id}', [TopicsController::class, 'topicsRelatedLoad'])->name('topicsRelatedLoad');
Route::get('/{webmasterId}/topics/{id}/related/create',
    [TopicsController::class, 'relatedCreate'])->name('topicsRelatedCreate');
Route::post('/{webmasterId}/topics/{id}/related/store',
    [TopicsController::class, 'relatedStore'])->name('topicsRelatedStore');
Route::get('/{webmasterId}/topics/{id}/related/destroy/{related_id}',
    [TopicsController::class, 'relatedDestroy'])->name('topicsRelatedDestroy');
Route::post('/{webmasterId}/topics/{id}/related/updateAll',
    [TopicsController::class, 'relatedUpdateAll'])->name('topicsRelatedUpdateAll');
// Topics :Comments
Route::get('/{webmasterId}/topics/{id}/comments', [TopicsController::class, 'topicsComments'])->name('topicsComments');
Route::get('/{webmasterId}/topics/{id}/comments/create',
    [TopicsController::class, 'commentsCreate'])->name('topicsCommentsCreate');
Route::post('/{webmasterId}/topics/{id}/comments/store',
    [TopicsController::class, 'commentsStore'])->name('topicsCommentsStore');
Route::get('/{webmasterId}/topics/{id}/comments/{comment_id}/edit',
    [TopicsController::class, 'commentsEdit'])->name('topicsCommentsEdit');
Route::post('/{webmasterId}/topics/{id}/comments/{comment_id}/update',
    [TopicsController::class, 'commentsUpdate'])->name('topicsCommentsUpdate');
Route::get('/{webmasterId}/topics/{id}/comments/destroy/{comment_id}',
    [TopicsController::class, 'commentsDestroy'])->name('topicsCommentsDestroy');
Route::post('/{webmasterId}/topics/{id}/comments/updateAll',
    [TopicsController::class, 'commentsUpdateAll'])->name('topicsCommentsUpdateAll');
// Topics :Maps
Route::get('/{webmasterId}/topics/{id}/maps', [TopicsController::class, 'topicsMaps'])->name('topicsMaps');
Route::get('/{webmasterId}/topics/{id}/maps/create', [TopicsController::class, 'mapsCreate'])->name('topicsMapsCreate');
Route::post('/{webmasterId}/topics/{id}/maps/store', [TopicsController::class, 'mapsStore'])->name('topicsMapsStore');
Route::get('/{webmasterId}/topics/{id}/maps/{map_id}/edit', [TopicsController::class, 'mapsEdit'])->name('topicsMapsEdit');
Route::post('/{webmasterId}/topics/{id}/maps/{map_id}/update',
    [TopicsController::class, 'mapsUpdate'])->name('topicsMapsUpdate');
Route::get('/{webmasterId}/topics/{id}/maps/destroy/{map_id}',
    [TopicsController::class, 'mapsDestroy'])->name('topicsMapsDestroy');
Route::post('/{webmasterId}/topics/{id}/maps/updateAll',
    [TopicsController::class, 'mapsUpdateAll'])->name('topicsMapsUpdateAll');

Route::post('/table-columns-update', [TopicsController::class, 'update_table_columns'])->name('tableColumnsUpdate');

// keditor
Route::get('/keditor/{topic_id?}', [TopicsController::class, 'keditor'])->name('keditor');
Route::get('/keditor-snippets', [TopicsController::class, 'keditor_snippets'])->name('keditorSnippets');
Route::post('/keditor-save', [TopicsController::class, 'keditor_save'])->name('keditorSave');

// Contacts Groups
Route::post('/contacts/storeGroup', [ContactsController::class, 'storeGroup'])->name('contactsStoreGroup');
Route::get('/contacts/{id}/editGroup', [ContactsController::class, 'editGroup'])->name('contactsEditGroup');
Route::post('/contacts/{id}/updateGroup', [ContactsController::class, 'updateGroup'])->name('contactsUpdateGroup');
Route::get('/contacts/destroyGroup/{id}', [ContactsController::class, 'destroyGroup'])->name('contactsDestroyGroup');
// Contacts
Route::get('/contacts/{group_id?}', [ContactsController::class, 'index'])->name('contacts');
Route::post('/contacts/store', [ContactsController::class, 'store'])->name('contactsStore');
Route::post('/contacts/search', [ContactsController::class, 'search'])->name('contactsSearch');
Route::get('/contacts/{id}/edit', [ContactsController::class, 'edit'])->name('contactsEdit');
Route::post('/contacts/{id}/update', [ContactsController::class, 'update'])->name('contactsUpdate');
Route::get('/contacts/destroy/{id}', [ContactsController::class, 'destroy'])->name('contactsDestroy');
Route::post('/contacts/updateAll', [ContactsController::class, 'updateAll'])->name('contactsUpdateAll');

// WebMails Groups
Route::post('/webmails/storeGroup', [WebmailsController::class, 'storeGroup'])->name('webmailsStoreGroup');
Route::get('/webmails/{id}/editGroup', [WebmailsController::class, 'editGroup'])->name('webmailsEditGroup');
Route::post('/webmails/{id}/updateGroup', [WebmailsController::class, 'updateGroup'])->name('webmailsUpdateGroup');
Route::get('/webmails/destroyGroup/{id}', [WebmailsController::class, 'destroyGroup'])->name('webmailsDestroyGroup');
// WebMails
Route::post('/webmails/store', [WebmailsController::class, 'store'])->name('webmailsStore');
Route::post('/webmails/search', [WebmailsController::class, 'search'])->name('webmailsSearch');
Route::get('/webmails/{id}/edit', [WebmailsController::class, 'edit'])->name('webmailsEdit');
Route::get('/webmails/{group_id?}/{wid?}/{stat?}/{contact_email?}', [WebmailsController::class, 'index'])->name('webmails');
Route::post('/webmails/{id}/update', [WebmailsController::class, 'update'])->name('webmailsUpdate');
Route::get('/webmails/destroy/{id}', [WebmailsController::class, 'destroy'])->name('webmailsDestroy');
Route::post('/webmails/updateAll', [WebmailsController::class, 'updateAll'])->name('webmailsUpdateAll');

// Calendar
Route::get('/calendar', [EventsController::class, 'index'])->name('calendar');
Route::get('/calendar/create', [EventsController::class, 'create'])->name('calendarCreate');
Route::post('/calendar/store', [EventsController::class, 'store'])->name('calendarStore');
Route::get('/calendar/{id}/edit', [EventsController::class, 'edit'])->name('calendarEdit');
Route::post('/calendar/{id}/update', [EventsController::class, 'update'])->name('calendarUpdate');
Route::get('/calendar/destroy/{id}', [EventsController::class, 'destroy'])->name('calendarDestroy');
Route::get('/calendar/updateAll', [EventsController::class, 'updateAll'])->name('calendarUpdateAll');
Route::post('/calendar/{id}/extend', [EventsController::class, 'extend'])->name('calendarExtend');

// Analytics
Route::get('/ip/{ip_code?}', [AnalyticsController::class, 'ip'])->name('visitorsIP');
Route::post('/ip/search', [AnalyticsController::class, 'search'])->name('visitorsSearch');
Route::post('/analytics/{stat}', [AnalyticsController::class, 'filter'])->name('analyticsFilter');
Route::get('/analytics/{stat?}', [AnalyticsController::class, 'index'])->name('analytics');
Route::get('/visitors', [AnalyticsController::class, 'visitors'])->name('visitors');

// Users & Permissions
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/create/', [UsersController::class, 'create'])->name('usersCreate');
Route::post('/users/store', [UsersController::class, 'store'])->name('usersStore');
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('usersEdit');
Route::post('/users/{id}/update', [UsersController::class, 'update'])->name('usersUpdate');
Route::get('/users/destroy/{id}', [UsersController::class, 'destroy'])->name('usersDestroy');
Route::post('/users/updateAll', [UsersController::class, 'updateAll'])->name('usersUpdateAll');

Route::get('/users/permissions/create/', [UsersController::class, 'permissions_create'])->name('permissionsCreate');
Route::post('/users/permissions/store', [UsersController::class, 'permissions_store'])->name('permissionsStore');
Route::get('/users/permissions/{id}/edit', [UsersController::class, 'permissions_edit'])->name('permissionsEdit');
Route::post('/users/permissions/{id}/update', [UsersController::class, 'permissions_update'])->name('permissionsUpdate');
Route::post('/users/permissions/{id}/save', [UsersController::class, 'update_custom_home'])->name('permissionsHomePageUpdate');
Route::get('/users/permissions/destroy/{id}', [UsersController::class, 'permissions_destroy'])->name('permissionsDestroy');

Route::post('/permissions-links/store', [UsersController::class, 'links_store'])->name('customLinksStore');
Route::post('/permissions-links/update', [UsersController::class, 'links_update'])->name('customLinksUpdate');
Route::get('/permissions-links/edit/{id?}/{p_id?}', [UsersController::class, 'links_edit'])->name('customLinksEdit');
Route::get('/permissions-links/destroy/{id?}/{p_id?}', [UsersController::class, 'links_destroy'])->name('customLinksDestroy');
Route::get('/permissions-links/list/{p_id?}', [UsersController::class, 'links_list'])->name('customLinksList');


// Menus
Route::post('/menus/store/parent', [MenusController::class, 'storeMenu'])->name('parentMenusStore');
Route::get('/menus/parent/{id}/edit', [MenusController::class, 'editMenu'])->name('parentMenusEdit');
Route::post('/menus/{id}/update/{ParentMenuId}', [MenusController::class, 'updateMenu'])->name('parentMenusUpdate');
Route::get('/menus/parent/destroy/{id}', [MenusController::class, 'destroyMenu'])->name('parentMenusDestroy');

Route::get('/menus/{ParentMenuId?}', [MenusController::class, 'index'])->name('menus');
Route::get('/menus/create/{ParentMenuId?}', [MenusController::class, 'create'])->name('menusCreate');
Route::post('/menus/store/{ParentMenuId?}', [MenusController::class, 'store'])->name('menusStore');
Route::get('/menus/{id}/edit/{ParentMenuId?}', [MenusController::class, 'edit'])->name('menusEdit');
Route::post('/menus/{id}/update', [MenusController::class, 'update'])->name('menusUpdate');
Route::get('/menus/destroy/{id}', [MenusController::class, 'destroy'])->name('menusDestroy');
Route::post('/menus/updateAll', [MenusController::class, 'updateAll'])->name('menusUpdateAll');

// Tags
Route::get('/tags', [TagController::class, 'index'])->name('tags');
Route::post('/tags/list', [TagController::class, 'list'])->name('tagsList');
Route::get('/tags/create', [TagController::class, 'create'])->name('tagsCreate');
Route::post('/tags/store', [TagController::class, 'store'])->name('tagsStore');
Route::get('/tags/edit/{id?}', [TagController::class, 'edit'])->name('tagsEdit');
Route::post('/tags/update', [TagController::class, 'update'])->name('tagsUpdate');
Route::get('/tags/destroy/{id?}', [TagController::class, 'destroy'])->name('tagsDestroy');
Route::post('/tags/updateAll', [TagController::class, 'updateAll'])->name('tagsUpdateAll');

// popups
Route::get('/popups', [PopupController::class, 'index'])->name('popups');
Route::get('/popups/create', [PopupController::class, 'create'])->name('popupsCreate');
Route::post('/popups/store', [PopupController::class, 'store'])->name('popupsStore');
Route::get('/popups/edit/{id}', [PopupController::class, 'edit'])->name('popupsEdit');
Route::post('/popups/update', [PopupController::class, 'update'])->name('popupsUpdate');
Route::get('/popups/destroy/{id?}', [PopupController::class, 'destroy'])->name('popupsDestroy');
Route::post('/popups/updateAll', [PopupController::class, 'updateAll'])->name('popupsUpdateAll');

// File manager
Route::get('file-manager', [FileManagerController::class, 'index'])->name('FileManager');
Route::get('files-manager', [FileManagerController::class, 'manager'])->name('FilesManager');

// No Permission
Route::get('/403', [DashboardController::class, 'page_403']);
Route::get('/oops', [DashboardController::class, 'page_oops'])->name('NoPermission');

// Clear Cache
Route::get('/cache-clear', [DashboardController::class, 'cache_clear'])->name('cacheClear');
Route::get('/cache-cleared', [DashboardController::class, 'cache_cleared'])->name('cacheCleared');
// logout
Route::get('/logout', [DashboardController::class, 'logout'])->name('adminLogout');

/*Manage CRM*/
//Payment Settings
Route::get('/paymentgateway', [LeaguecrmController::class, 'payments'])->name('paymentgateway');
Route::post('/paymentsettingsUpdate', [LeaguecrmController::class, 'paymentsettingsUpdate'])->name('paymentsettingsUpdate');


Route::get('/paymentapproval', [PaymentController::class, 'index'])
    ->name('paymentApproval');

Route::get('/paymentapproval/show/{id}', [PaymentController::class, 'show'])
    ->name('paymentApproval.show');

Route::post('/paymentapproval/approve/{id}', [PaymentController::class, 'approve'])
    ->name('transactions.approve');

Route::post('/paymentapproval/reject/{id}', [PaymentController::class, 'reject'])
    ->name('transactions.reject');
    


// ================= WALLET WITHDRAW =================

Route::get('/walletwithdraw', [PaymentController::class, 'walletwithdraw'])
    ->name('walletwithdraw');

Route::get('/walletwithdraw/show/{id}', [PaymentController::class, 'walletwithdrawshow'])
    ->name('walletwithdraw.show');

Route::post('/walletwithdraw/approve/{id}', [PaymentController::class, 'approvewallet'])
    ->name('walletwithdraw.approve');

Route::post('/walletwithdraw/reject/{id}', [PaymentController::class, 'reject'])
    ->name('walletwithdraw.reject');

Route::post('/kyc/approve/{id}', [KycController::class, 'approve'])->name('kyc.approve');


Route::get('/kyclist', [KycController::class, 'index'])->name('kyclist');
Route::post('/kyc/reject/{id}', [KycController::class, 'reject'])->name('kyc.reject');
Route::get('/kyc/show/{id}', [KycController::class, 'show'])->name('kyc.show');

Route::get('/admin/kyc/{id}', [KycController::class, 'viewKyc'])->name('kyc.view');

// Approve KYC
Route::post('/admin/kyc/approve/{id}', [KycController::class, 'approveKyc'])->name('kyc.approve');

// Reject KYC
Route::post('/admin/kyc/reject/{id}', [KycController::class, 'rejectKyc'])->name('kyc.reject');

/*MT5 Configuration*/
Route::get('/mt5serverlist', [SettingsController::class, 'mt5serverlist'])->name('mt5serverlist');
Route::get('/smtpconfig', [SettingsController::class, 'smtpconfig'])->name('smtpconfig');
Route::get('/platformconfig', [SettingsController::class, 'platformconfig'])->name('platformconfig');
Route::post('/mt5configstore', [SettingsController::class, 'mt5configstore'])->name('mt5configstore');
Route::get('/mt5/{id}/edit', [SettingsController::class, 'editMt5Account'])->name('mt5Edit');

// Create MT5 Account Form
Route::get('/mt5/create', [SettingsController::class, 'createMt5Account'])->name('mt5accounts.create');

// Store New MT5 Account
Route::post('/mt5/store', [SettingsController::class, 'storeMt5Account'])->name('mt5accounts.store');

// Optional: MT5 Account Update Route
Route::put('/mt5/{id}', [SettingsController::class, 'updateMt5Account'])->name('mt5Update');
/*Client*/
Route::get('/clientlist', [ClientController::class, 'clientlist'])->name('clientlist');
Route::post('/clients/updateAll', [ClientController::class, 'clientsUpdateAll'])->name('clientsUpdateAll');
Route::get('/client/create/', [ClientController::class, 'clientcreate'])->name('clientCreate');
Route::post('/client/clientregister/', [ClientController::class, 'clientregister'])->name('clientregister');
Route::post('/resend/{id}', [ClientController::class, 'resendVerification'])->name('resend');
Route::get('/client/{id}/edit', [ClientController::class, 'clientedit'])->name('clientedit');
Route::post('/client/{id}/update', [ClientController::class, 'clientupdate'])->name('clientupdate');
Route::get('/client/{userid}/view', [ClientController::class, 'clientview'])->name('clientview');

/*Leader Users*/
Route::get('/leaderuserlist', [ClientController::class, 'leaderuserlist'])->name('leaderuserlist');
Route::get('/leaderuser/create/', [ClientController::class, 'leaderusercreate'])->name('leaderusercreate');
Route::post('/leaderuser/leaderuserregister/', [ClientController::class, 'leaderuserregister'])->name('leaderuserregister');
Route::get('/leaderuser/{id}/edit', [ClientController::class, 'leaderuseredit'])->name('leaderuseredit');
Route::post('/leaderuser/{id}/update', [ClientController::class, 'leaderuserupdate'])->name('leaderuserupdate');

/*Accouunts*/
Route::get('/touraccountlist', [ClientController::class, 'touraccountlist'])->name('touraccountlist');
Route::get('/account/{tradeid}/view', [ClientController::class, 'accountview'])->name('accountview');

/*Bank & Wallet*/
Route::get('/banklist', [ClientController::class, 'banklist'])->name('banklist');
Route::get('/walletlist', [ClientController::class, 'walletlist'])->name('walletlist');

/*Tournament*/
Route::get('/categorylist', [TournamentController::class, 'categorylist'])->name('categorylist');
 Route::post('categoriesstore', [TournamentController::class, 'categoriesstore'])->name('categoriesstore');
    Route::post('/categories/{id}', [TournamentController::class, 'destroy'])->name('categories.destroy');
Route::get('/leaguelist', [TournamentController::class, 'leaguelist'])->name('leaguelist');
Route::get('/leaguecreate', [TournamentController::class, 'leaguecreate'])->name('leaguecreate');
Route::post('/leaguestore', [TournamentController::class, 'leaguestore'])->name('leaguestore');
Route::post('/catnameexit', [TournamentController::class, 'catnameexit'])->name('catnameexit');
Route::post('getSubcat', [TournamentController::class, 'getSubcat'])->name('getSubcat');
Route::post('/getMt5Groups', [TournamentController::class, 'getMt5Groups'])->name('getMt5Groups');
Route::post('/leaguesave', [TournamentController::class, 'leaguesave'])->name('leaguesave');

  Route::get('leagues/{id}/edit', [TournamentController::class, 'edit'])->name('leagueedit');
    Route::post('leagues/{id}/update', [TournamentController::class, 'update'])->name('leagueupdate');
    
    
    Route::get('/mt5group', [SettingsController::class, 'mt5group'])->name('mt5group');

    Route::post('/getmt5group', [SettingsController::class, 'getmt5group'])->name('getmt5group');

    Route::post('/mt5groupadd', [SettingsController::class, 'mt5groupadd'])->name('mt5groupadd');

    
Route::post('/mt5groupCategoryAdd', [SettingsController::class, 'mt5groupCategoryAdd'])->name('mt5groupCategoryAdd');

Route::post('/mt5GroupTypeAdd', [SettingsController::class, 'mt5GroupTypeAdd'])->name('mt5GroupTypeAdd');
Route::post('/mt5Groupcreate', [SettingsController::class, 'mt5Groupcreate'])->name('mt5Groupcreate');

/*Manual Leader Board*/
Route::get('/leaderranklist', [TournamentController::class, 'leaderranklist'])->name('leaderranklist');
Route::get('/leaderrankcreate', [TournamentController::class, 'leaderrankcreate'])->name('leaderrankcreate');
Route::post('/getTournament', [TournamentController::class, 'getTournament'])->name('getTournament');
Route::post('/getTournamentuser', [TournamentController::class, 'getTournamentuser'])->name('getTournamentuser');
Route::post('/getliveaccountbalance', [TournamentController::class, 'getliveaccountbalance'])->name('getliveaccountbalance');
Route::post('/storeleaderrank', [TournamentController::class, 'storeleaderrank'])->name('storeleaderrank');
Route::get('/leaderrank/{id}/edit', [TournamentController::class, 'leaderrankedit'])->name('leaderrankedit');
Route::put('/leaderrank/{id}', [TournamentController::class, 'leaderrankupdate'])->name('leaderrankupdate');

/*League Prize*/
Route::get('/leagueprizelist', [TournamentController::class, 'leagueprizelist'])->name('leagueprizelist');
Route::get('/leagueprizecreate', [TournamentController::class, 'leagueprizecreate'])->name('leagueprizecreate');
Route::post('/leagueprizestore', [TournamentController::class, 'leagueprizestore'])->name('leagueprizestore');
Route::get('/leagueprize/{id}/edit', [TournamentController::class, 'leagueprizeedit'])->name('leagueprizeedit');
Route::put('/leagueprize/{id}', [TournamentController::class, 'leagueprizeupdate'])->name('leagueprizeupdate');

/*Prize Distribute*/
Route::get('/leagueprizeresult/{id}', [TournamentController::class, 'leagueprizeresult'])->name('leagueprizeresult');
Route::post('/distributePrize/{id}', [TournamentController::class, 'distributePrize'])->name('distributePrize');

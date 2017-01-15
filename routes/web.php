<?php

/*------------ FRONTEND ROUTES ------------*/

Route::get('/', 'IndexController@index');

/*------------ BACKEND ROUTES ------------*/
Route::get('/backend/', 'backend\IndexController@index');

//BACKEND PREVIEW
Route::get('/backend-preview/', 'backend\IndexController@index_preview');

//SUBPAGES OVERVIEW
Route::get('/backend/subpages_2/overview', 'backend\IndexController@getSubPageOverview');

//SUB SUBPAGES OVERVIEW
Route::get('/backend/subpages_3/overview', 'backend\IndexController@getSubSubPageOverview');

//WIDGETS OVERVIEW
Route::get('/backend/widgets/overview', 'backend\IndexController@getWidgetOverview');

//SUBWIDGETS OVERVIEW
Route::get('/backend/subwidgets_2/overview', 'backend\IndexController@getSubWidgetOverview');

//SUB SUBWIDGETS OVERVIEW
Route::get('/backend/subwidgets_3/overview', 'backend\IndexController@getSubSubWidgetOverview');

//NEW PAGE
Route::get('/backend/new_page', ['middleware' => ['permission:page-create'], 'uses' => 'backend\IndexController@getNewPage']);
Route::post('/backend/new_page/create', ['middleware' => ['permission:page-create'], 'uses' => 'backend\IndexController@postNewPage']);

//NEW SUB PAGE
Route::get('/backend/new_sub_page_2', ['middleware' => ['permission:sub-page-create'], 'uses' => 'backend\IndexController@getNewSubPage']);
Route::get('/backend/new_sub_page_2/{id}', ['middleware' => ['permission:sub-page-create'], 'uses' => 'backend\IndexController@getNewSubPageId']);
Route::post('/backend/new_sub_page_2/create', ['middleware' => ['permission:sub-page-create'], 'uses' => 'backend\IndexController@postNewSubPage']);

//NEW SUB SUB PAGE
Route::get('/backend/new_sub_page_3', ['middleware' => ['permission:create-sub-sub-page'], 'uses' => 'backend\IndexController@getNewSubSubPage']);
Route::get('/backend/new_sub_page_3/{id}', ['middleware' => ['permission:create-sub-sub-page'], 'uses' => 'backend\IndexController@getNewSubSubPageId']);
Route::post('/backend/new_sub_page_3/create', ['middleware' => ['permission:create-sub-sub-page'], 'uses' => 'backend\IndexController@postNewSubSubPage']);

//NEW WIDGET
Route::get('/backend/new_widget', ['middleware' => ['permission:create-widget'], 'uses' => 'backend\IndexController@getNewWidget']);
Route::get('/backend/new_widget/{id}', ['middleware' => ['permission:create-widget'], 'uses' => 'backend\IndexController@getNewWidgetId']);
Route::post('/backend/new_widget/create', ['middleware' => ['permission:create-widget'], 'uses' => 'backend\IndexController@postNewWidget']);

//NEW SUBWIDGET
Route::get('/backend/new_sub_widget_2', ['middleware' => ['permission:create-sub-widget'], 'uses' => 'backend\IndexController@getNewSubWidget']);
Route::get('/backend/new_sub_widget_2/{id}', ['middleware' => ['permission:create-sub-widget'], 'uses' => 'backend\IndexController@getNewSubWidgetId']);
Route::post('/backend/new_sub_widget_2/create', ['middleware' => ['permission:create-sub-widget'], 'uses' => 'backend\IndexController@postNewSubWidget']);

//NEW SUB SUB WIDGET
Route::get('/backend/new_sub_widget_3', ['middleware' => ['permission:create-sub-sub-widget'], 'uses' => 'backend\IndexController@getNewSubSubWidget']);
Route::get('/backend/new_sub_widget_3/{id}', ['middleware' => ['permission:create-sub-sub-widget'], 'uses' => 'backend\IndexController@getNewSubSubWidgetId']);
Route::post('/backend/new_sub_widget_3/create', ['middleware' => ['permission:create-sub-sub-widget'], 'uses' => 'backend\IndexController@postNewSubSubWidget']);

/* DashBoard - PAGES */
Route::get('/backend/page/{slug}', 'backend\DashBoardPagesWidgetsController@getDashBoardMenuPage');
Route::get('/backend/subpage_2/{slug}/{sub_slug}', 'backend\DashBoardPagesWidgetsController@getDashBoardMenuSubPage');
Route::get('/backend/subpage_3/{slug}/{sub_slug}/{sub_sub_slug}', 'backend\DashBoardPagesWidgetsController@getDashBoardMenuSubSubPage');

/* DashBoard - PAGES - CRUD */
Route::post('/backend/page/{slug}/edit/{id}', ['middleware' => ['permission:page-edit'], 'uses' => 'backend\DashBoardPagesWidgetsController@postDashBoardMenuItemEdit']);
Route::post('/backend/subpage_2/{slug}/{sub_slug}/edit/{id}', ['middleware' => ['permission:sub-page-edit'], 'uses' => 'backend\DashBoardPagesWidgetsController@postDashBoardMenuSubItemEdit']);
Route::post('/backend/subpage_3/{slug}/{sub_slug}/{sub_sub_slug}/edit/{id}', ['middleware' => ['permission:sub-sub-page-edit'], 'uses' => 'backend\DashBoardPagesWidgetsController@postDashBoardMenuSubSubItemEdit']);

/* DashBoard - WIDGETS */
Route::get('/backend/widget/{slug}', 'backend\DashBoardPagesWidgetsController@getWidgetPage');
Route::get('/backend/widget/{slug}/details/{id}', 'backend\DashBoardPagesWidgetsController@getWidgetPageDetails');
Route::get('/backend/subwidget_2/{slug}/{sub_slug}', 'backend\DashBoardPagesWidgetsController@getWidgetSubPage');
Route::get('/backend/subwidget_2/{slug}/{sub_slug}/details/{id}', 'backend\DashBoardPagesWidgetsController@getWidgetSubPageDetails');
Route::get('/backend/subwidget_3/{slug}/{sub_slug}/{sub_sub_slug}', 'backend\DashBoardPagesWidgetsController@getWidgetSubSubPage');
Route::get('/backend/subwidget_3/{slug}/{sub_slug}/{sub_sub_slug}/details/{id}', 'backend\DashBoardPagesWidgetsController@getWidgetSubSubPageDetails');

/* DashBoard - WIDGETS - CRUD */
Route::post('/backend/widget/{slug}/details/{id}/edit', ['middleware' => ['permission:edit-widget'], 'uses' => 'backend\DashBoardPagesWidgetsController@getWidgetPageDetailsEdit']);
Route::post('/backend/subwidget_2/{slug}/{sub_slug}/details/{id}/edit', ['middleware' => ['permission:edit-sub-widget'], 'uses' => 'backend\DashBoardPagesWidgetsController@getWidgetSubPageDetailsEdit']);
Route::post('/backend/subwidget_3/{slug}/{sub_slug}/{sub_sub_slug}/details/{id}/edit', ['middleware' => ['permission:edit-sub-sub-widget'], 'uses' => 'backend\DashBoardPagesWidgetsController@getWidgetSubSubPageDetailsEdit']);

/* DashBoard - GALLERY */
Route::get('/backend/gallerij', 'backend\DashBoardGalleryController@getDashBoardGallery');

/* DashBoard - PERMISSIONS-CONTROL - Categories */
Route::get('/backend/categories', ['middleware' => ['permission:category-page'], 'uses' => 'backend\DashBoardRolesPermissionsController@getCategoryPage']);
Route::get('/backend/categories/new', ['middleware' => ['permission:category-create'], 'uses' => 'backend\DashBoardRolesPermissionsController@getCategoryCreatePage']);
Route::post('/backend/categories/new', ['middleware' => ['permission:category-create'], 'uses' => 'backend\DashBoardRolesPermissionsController@postCategoryCreatePage']);
Route::get('/backend/categories/{category_id}/edit', ['middleware' => ['permission:category-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@getCategoryEditPage']);
Route::post('/backend/categories/{category_id}/edit', ['middleware' => ['permission:category-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@postCategoryEditPage']);
Route::post('/backend/categories/{category_id}/lock', ['middleware' => ['permission:category-lock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postCategoryLockPage']);
Route::post('/backend/categories/{category_id}/unlock', ['middleware' => ['permission:category-unlock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postCategoryUnlockPage']);
Route::post('/backend/categories/{category_id}/delete', ['middleware' => ['permission:category-delete'], 'uses' => 'backend\DashBoardRolesPermissionsController@postCategoryDeletePage']);

/* DashBoard - PERMISSIONS-CONTROL - Permissions */
Route::get('/backend/permissions', ['middleware' => ['permission:permissions-page'], 'uses' => 'backend\DashBoardRolesPermissionsController@getPermissionsPage']);
Route::get('/backend/permissions/new', ['middleware' => ['permission:permissions-create'], 'uses' => 'backend\DashBoardRolesPermissionsController@getPermissionsCreatePage']);
Route::post('/backend/permissions/new', ['middleware' => ['permission:permissions-create'], 'uses' => 'backend\DashBoardRolesPermissionsController@postPermissionsCreatePage']);
Route::get('/backend/permissions/{permission_id}/edit', ['middleware' => ['permission:permissions-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@getPermissionsEditPage']);
Route::post('/backend/permissions/{permission_id}/edit', ['middleware' => ['permission:permissions-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@postPermissionsEditPage']);
Route::post('/backend/permissions/{permission_id}/lock', ['middleware' => ['permission:permissions-lock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postPermissionsLockPage']);
Route::post('/backend/permissions/{permission_id}/unlock', ['middleware' => ['permission:permissions-unlock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postPermissionsUnlockPage']);
Route::post('/backend/permissions/{permission_id}/delete', ['middleware' => ['permission:permissions-delete'], 'uses' => 'backend\DashBoardRolesPermissionsController@postPermissionsDeletePage']);

/* DashBoard - PERMISSIONS-CONTROL - User-Permissions */
Route::get('/backend/users-permissions', ['middleware' => ['permission:user-permissions-overview'], 'uses' => 'backend\DashBoardRolesPermissionsController@getUsersPermissionsPage']);
Route::get('/backend/users-permissions/link', ['middleware' => ['permission:user-permissions-link'], 'uses' => 'backend\DashBoardRolesPermissionsController@getUsersPermissionsLinkPage']);
Route::post('/backend/users-permissions/link', ['middleware' => ['permission:user-permissions-link'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersPermissionsLinkPage']);
Route::get('/backend/users-permissions/{permission_id}/{role_id}/edit', ['middleware' => ['permission:user-permissions-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@getUsersPermissionsEditPage']);
Route::post('/backend/users-permissions/{permission_id}/{role_id}/edit', ['middleware' => ['permission:user-permissions-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersPermissionsEditPage']);
Route::post('/backend/users-permissions/{permission_id}/lock', ['middleware' => ['permission:user-permissions-lock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersPermissionsLockPage']);
Route::post('/backend/users-permissions/{permission_id}/unlock', ['middleware' => ['permission:user-permissions-unlock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersPermissionsUnlockPage']);
Route::post('/backend/users-permissions/{user_id}/{permission_id}/delete', ['middleware' => ['permission:user-permissions-delete'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersPermissionsDeletePage']);

/* DashBoard - PERMISSIONS-CONTROL - Roles */
Route::get('/backend/roles', ['middleware' => ['permission:roles-page'], 'uses' => 'backend\DashBoardRolesPermissionsController@getRolesPage']);
Route::get('/backend/roles/new', ['middleware' => ['permission:roles-create'], 'uses' => 'backend\DashBoardRolesPermissionsController@getRolesCreatePage']);
Route::post('/backend/roles/new', ['middleware' => ['permission:roles-create'], 'uses' => 'backend\DashBoardRolesPermissionsController@postRolesCreatePage']);
Route::get('/backend/roles/{role_id}/edit', ['middleware' => ['permission:roles-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@getRolesEditPage']);
Route::post('/backend/roles/{role_id}/edit', ['middleware' => ['permission:roles-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@postRolesEditPage']);
Route::post('/backend/roles/{role_id}/lock', ['middleware' => ['permission:roles-lock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postRolesLockPage']);
Route::post('/backend/roles/{role_id}/unlock', ['middleware' => ['permission:roles-unlock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postRolesUnlockPage']);
Route::post('/backend/roles/{role_id}/delete', ['middleware' => ['permission:roles-delete'], 'uses' => 'backend\DashBoardRolesPermissionsController@postRolesDeletePage']);

/* DashBoard - PERMISSIONS-CONTROL - User-roles */
Route::get('/backend/users-roles', ['middleware' => ['permission:user-roles-overview'], 'uses' => 'backend\DashBoardRolesPermissionsController@getUsersRolesPage']);
Route::get('/backend/users-roles/link', ['middleware' => ['permission:user-roles-link'], 'uses' => 'backend\DashBoardRolesPermissionsController@getUsersRolesLinkPage']);
Route::post('/backend/users-roles/link', ['middleware' => ['permission:user-roles-link'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersRolesLinkPage']);
Route::get('/backend/users-roles/{role_id}/{user_id}/edit', ['middleware' => ['permission:user-roles-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@getUsersRolesEditPage']);
Route::post('/backend/users-roles/{role_id}/{user_id}/edit', ['middleware' => ['permission:user-roles-edit'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersRolesEditPage']);
Route::post('/backend/users-roles/{role_id}/lock', ['middleware' => ['permission:user-roles-lock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersRolesLockPage']);
Route::post('/backend/users-roles/{role_id}/unlock', ['middleware' => ['permission:user-roles-unlock'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersRolesUnlockPage']);
Route::post('/backend/users-roles/{user_id}/{role_id}/delete', ['middleware' => ['permission:user-roles-delete'], 'uses' => 'backend\DashBoardRolesPermissionsController@postUsersRolesDeletePage']);

/* TO DO LIST */
Route::post('/backend/add_item_to_do/', 'backend\IndexController@postToDo');
Route::post('/backend/item_delete/{id}', 'backend\IndexController@postDelete');
Route::post('/backend/updateTextField', 'backend\IndexController@postUpdateTextField');
Route::post('/backend/updateRankField', 'backend\IndexController@postUpdateRankField');

/* CONTACT FORM */
Route::post('/backend/problem_contact','backend\IndexController@postProblemContact');

/*------------ AUTH ROUTES ------------*/
Auth::routes();

Route::get('/register_admin', ['middleware' => ['permission:user-create'], 'uses' => 'backend\IndexController@getRegisterAdmin']);
Route::post('/register_admin', ['middleware' => ['permission:user-create'], 'uses' => 'backend\IndexController@postRegisterAdmin']);

Route::get('logout', function (){
    Auth::logout();
    return redirect('/login');
});
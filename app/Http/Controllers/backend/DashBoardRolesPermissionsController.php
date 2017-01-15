<?php namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Models\Permission;
use App\Models\PermissionCategory;
use App\Models\Role;
use App\User;
use App\Models\MenuSubSubItem;
use App\Models\PageItem;
use App\Models\PageSubItem;
use App\Models\PageSubSubItem;
use App\Models\VisibilityItem;
use App\Models\WidgetItem;
use App\Models\WidgetSubItem;
use App\Models\WidgetSubSubItem;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Models\MenuCategorie;
use App\Models\MenuItem;
use App\Models\MenuSubItem;
use App\Models\ToDoList;

use Validator;
use Auth;
use Mail;

class DashBoardRolesPermissionsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /* PERMISSIONS USERS PAGE */
    public function getUsersPermissionsPage(){

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET USERS */
        $users = User::with('roles')->get();

        /* GET ROLES */
        $roles = Role::with('permissions')->get();

        /* GET PERMISSIONS */
        $permissions = Permission::all();

        /* GET PERMISSIONS-CATEGOROES */
        $permission_categories = PermissionCategory::all();

        return view('backend.dashboard.roles_permissions.users-permissions.users-permissions',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'users' => $users,
                'roles' => $roles,
                'permissions' => $permissions,
                'permission_categories' => $permission_categories,
            ]);
    }
    /* PERMISSIONS USERS PAGE - LINK PERMISSION - ROL*/
    public function getUsersPermissionsLinkPage(){

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $roles = ['0' => '-- Kies een gebruikersrol --'] + Role::pluck('name', 'id')->toArray();

        $permission_categories = PermissionCategory::with('permissions')->get();

        return view('backend.dashboard.roles_permissions.users-permissions.users-permissions_link',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'roles' => $roles,
                'permission_categories' => $permission_categories,

            ]);
    }
    /* PERMISSIONS USERS PAGE - POST LINK PERMISSION - ROL*/
    public function postUsersPermissionsLinkPage(){

        $data = Input::all();

        $rules = array(
            'role' => 'required|not_in:0',
            'permission' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/users-permissions/link')->withErrors($validator)->withInput();
        }

        //FIND RELATED ROLE WITH PERMISSION
        $role = Role::find($data['role']);
        $permission = Permission::find($data['permission']);

        //DETACH PERMISSION OF ROLE
        $role->attachPermission($permission);

        return Redirect::to('/backend/users-permissions')->with('succes_box_message','Toegangsrecht werd succesvol gekoppeld aan de gebruikersrol!');
    }
    /* PERMISSIONS USERS PAGE - EDIT PERMISSION - ROL*/
    public function getUsersPermissionsEditPage($permission_id, $role_id){

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $roles = ['0' => '-- Kies een gebruikersrol --'] + Role::pluck('name', 'id')->toArray();

        $permission_categories = PermissionCategory::with('permissions')->get();

        return view('backend.dashboard.roles_permissions.users-permissions.users-permissions_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'roles' => $roles,
                'permission_categories' => $permission_categories,
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ]);
    }
    /* PERMISSIONS USERS PAGE - POST EDIT PERMISSION - ROL*/
    public function postUsersPermissionsEditPage($permission_id, $role_id){

        $data = Input::all();

        $rules = array(
            'role' => 'required|not_in:0',
            'permission' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/users-permissions/'.$permission_id.'/'.$role_id.'/edit')->withErrors($validator)->withInput();
        }

        //FIND OLD RELATED ROLE WITH PERMISSION
        $old_role = Role::find($role_id);
        $old_permission = Permission::find($permission_id);

        //DETACH OLD PERMISSION OF ROLE
        $old_role->detachPermission($old_permission);

        //FIND NEW RELATED ROLE WITH PERMISSION
        $new_role = Role::find($data['role']);
        $new_permission = Permission::find($data['permission']);

        //ATTACH NEW PERMISSION OF ROLE
        $new_role->attachPermission($new_permission);

        return Redirect::to('/backend/users-permissions')->with('succes_box_message','Toegangsrecht werd succesvol gewijzigd!');
    }
    /* PERMISSIONS USERS PAGE - LOCK PERMISSION */
    public function postUsersPermissionsLockPage($id)
    {
        $now = date('Y-m-d H:i:s');

        $permission = Permission::find($id);
        $permission->deleted_at = $now;
        $permission->save();

        // redirect
        return Redirect::to('/backend/users-permissions')->with('succes_box_message','De toegang werd vergrendeld!');
    }
    /* PERMISSIONS USERS PAGE - UNLOCK PERMISSION */
    public function postUsersPermissionsUnlockPage($id)
    {
        $permission = Permission::find($id);
        $permission->deleted_at = null;
        $permission->save();

        // redirect
        return Redirect::to('/backend/users-permissions')->with('succes_box_message','De toegang werd ongrendeld!');
    }
    /* PERMISSIONS USERS PAGE - DELETE PERMISSION */
    public function postUsersPermissionsDeletePage($user_id, $permission_id)
    {
        //FIND RELATED ROLE WITH USER
        $user = User::find($user_id)->roles()->first();

        //DETACH ROLE OF USER
        $user->detachPermission($permission_id);

        // redirect
        return Redirect::to('/backend/users-permissions')->with('succes_box_message','De toegang werd verwijderd!');
    }
    /* CATEGORIES PAGE */
    public function getCategoryPage()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $categories = PermissionCategory::all();

        return view('backend.dashboard.roles_permissions.categories.categories',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'categories' => $categories,

            ]);
    }
    /* CATEGORIES PAGE - CREATE CATEGORY */
    public function getCategoryCreatePage()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        return view('backend.dashboard.roles_permissions.categories.categories_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
            ]);
    }
    /* CATEGORIES PAGE - POST CREATE CATEGORY */
    public function postCategoryCreatePage()
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/categories/new')->withErrors($validator)->withInput();
        }

        $category = New PermissionCategory();
        $category->name = $data['name'];
        $category->description = $data['description'];

        $category->save();

        return Redirect::to('/backend/categories')->with('succes_box_message','Een nieuwe categorie werd aangemaakt!');
    }
    /* CATEGORIES PAGE - EDIT CATEGORY */
    public function getCategoryEditPage($id)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET PERMISSIONS */
        $category = PermissionCategory::find($id);

        return view('backend.dashboard.roles_permissions.categories.categories_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'category' => $category,
            ]);
    }
    /* CATEGORIES PAGE - POST EDIT CATEGORY */
    public function postCategoryEditPage($id)
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/categories/'.$id)->withErrors($validator)->withInput();
        }

        $category = PermissionCategory::find($id);
        $category->name = $data['name'];
        $category->description = $data['description'];

        $category->save();

        return Redirect::to('/backend/categories')->with('succes_box_message','De categorie werd aangepast!');
    }
    /* CATEGORIES PAGE - LOCK CATEGORY */
    public function postCategoryLockPage($id)
    {
        $now = date('Y-m-d H:i:s');

        $category = PermissionCategory::find($id);
        $category->deleted_at = $now;
        $category->save();

        // redirect
        return Redirect::to('/backend/categories')->with('succes_box_message','De categorie werd vergrendeld!');
    }
    /* CATEGORIES PAGE - UNLOCK CATEGORY */
    public function postCategoryUnlockPage($id)
    {
        $category = PermissionCategory::find($id);
        $category->deleted_at = null;
        $category->save();

        // redirect
        return Redirect::to('/backend/categories')->with('succes_box_message','De categorie werd ongrendeld!');
    }
    /* CATEGORIES PAGE - DELETE CATEGORY */
    public function postCategoryDeletePage($id)
    {
        $category = PermissionCategory::find($id);
        $permissions = Permission::all();

        foreach($permissions as $value)
        {
            if($value->permission_category_id == $id)
            {
                //PERMISSION IS IN USE BY A USER
                return Redirect::to('/backend/categories')->with('error_box_message','De categorie is in gebruik!');
            }
            else{
                //PERMISSION IS NOT IN USE BY A USER
                $category->delete();
            }
        }
        // redirect
        return Redirect::to('/backend/categories')->with('succes_box_message','De categorie werd verwijderd!');
    }
    /* PERMISSIONS PAGE */
    public function getPermissionsPage()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET USERS */
        $users = User::with('roles')->get();

        /* GET ROLES */
        $roles = Role::with('permissions')->get();

        /* GET PERMISSIONS */
        $permissions = Permission::all();

        /* GET PERMISSIONS-CATEGOROES */
        $permission_categories = PermissionCategory::with('permissions')->get();

        return view('backend.dashboard.roles_permissions.permissions.permissions',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'users' => $users,
                'roles' => $roles,
                'permissions' => $permissions,
                'permission_categories' => $permission_categories,
            ]);
    }
    /* PERMISSIONS PAGE - CREATE PERMISSION */
    public function getPermissionsCreatePage()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $categories = ['0' => '-- Kies een categorie --'] + PermissionCategory::pluck('name', 'id')->toArray();

        return view('backend.dashboard.roles_permissions.permissions.permissions_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'categories' => $categories,
            ]);
    }
    /* PERMISSIONS PAGE - POST CREATE PERMISSION */
    public function postPermissionsCreatePage()
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
            'category' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/permissions/new')->withErrors($validator)->withInput();
        }

        $permission = New Permission();
        $permission->name = $data['name'];
        $permission->display_name = $data['display_name'];
        $permission->description = $data['description'];
        $permission->permission_category_id = $data['category'];

        $permission->save();

        return Redirect::to('/backend/permissions')->with('succes_box_message','Een nieuw toegangsrecht werd aangemaakt!');
    }
    /* PERMISSIONS PAGE - EDIT PERMISSION */
    public function getPermissionsEditPage($id)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET PERMISSIONS */
        $permissions = Permission::find($id);

        /* GET PERMISSIONS-CATEGOROES */
        $permission_categories = PermissionCategory::with('permissions')->get();

        return view('backend.dashboard.roles_permissions.permissions.permissions_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'permissions' => $permissions,
                'permission_categories' => $permission_categories,
            ]);
    }
    /* PERMISSIONS PAGE - POST EDIT PERMISSION */
    public function postPermissionsEditPage($id)
    {
        $data = Input::all();

        $rules = array(
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/permissions/'.$id)->withErrors($validator)->withInput();
        }

        $permission = Permission::find($id);
        $permission->display_name = $data['display_name'];
        $permission->description = $data['description'];

        $permission->save();

        return Redirect::to('/backend/permissions')->with('succes_box_message','De toegang werd aangepast!');
    }
    /* PERMISSIONS PAGE - LOCK PERMISSION */
    public function postPermissionsLockPage($id)
    {
        $now = date('Y-m-d H:i:s');

        $permission = Permission::find($id);
        $permission->deleted_at = $now;
        $permission->save();

        // redirect
        return Redirect::to('/backend/permissions')->with('succes_box_message','De toegang werd vergrendeld!');
    }
    /* PERMISSIONS PAGE - UNLOCK PERMISSION */
    public function postPermissionsUnlockPage($id)
    {
        $permission = Permission::find($id);
        $permission->deleted_at = null;
        $permission->save();

        // redirect
        return Redirect::to('/backend/permissions')->with('succes_box_message','De toegang werd ongrendeld!');
    }
    /* PERMISSIONS PAGE - DELETE PERMISSION */
    public function postPermissionsDeletePage($id)
    {
        $permission = Permission::find($id);
        $users = User::all();

        foreach($users as $value)
        {
            if($value->can($permission->name))
            {
                //PERMISSION IS IN USE BY A USER
                return Redirect::to('/backend/permissions')->with('error_box_message','De toegang is in gebruik!');
            }
            else{
                //PERMISSION IS NOT IN USE BY A USER
                $permission->delete();
            }
        }
        // redirect
        return Redirect::to('/backend/permissions')->with('succes_box_message','De toegang werd verwijderd!');
    }
    /* ROLES PAGE */
    public function getRolesPage()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET ROLES */
        $roles = Role::all();

        return view('backend.dashboard.roles_permissions.roles.roles',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'roles' => $roles,
            ]);
    }
    /* ROLES PAGE - CREATE ROLE */
    public function getRolesCreatePage()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        return view('backend.dashboard.roles_permissions.roles.roles_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
            ]);
    }
    /* ROLES PAGE - POST CREATE ROLE */
    public function postRolesCreatePage()
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/roles/new')->withErrors($validator)->withInput();
        }

        $role = New Role();
        $role->name = $data['name'];
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];

        $role->save();

        return Redirect::to('/backend/roles')->with('succes_box_message','Een nieuwe rol werd aangemaakt!');
    }
    /* ROLES PAGE - EDIT ROLE */
    public function getRolesEditPage($id)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET PERMISSIONS */
        $role = Role::find($id);

        return view('backend.dashboard.roles_permissions.roles.roles_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'role' => $role,
            ]);
    }
    /* ROLES PAGE - POST EDIT ROLE */
    public function postRolesEditPage($id)
    {
        $data = Input::all();

        $rules = array(
            'display_name' => 'required|max:255',
            'description' => 'required|max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/roles/'.$id)->withErrors($validator)->withInput();
        }

        $role = Role::find($id);
        $role->display_name = $data['display_name'];
        $role->description = $data['description'];

        $role->save();

        return Redirect::to('/backend/roles')->with('succes_box_message','De rol werd aangepast!');
    }
    /* ROLES PAGE - LOCK ROLE */
    public function postRolesLockPage($id)
    {
        $now = date('Y-m-d H:i:s');

        $role = Role::find($id);
        $role->deleted_at = $now;
        $role->save();

        // redirect
        return Redirect::to('/backend/roles')->with('succes_box_message','De rol werd vergrendeld!');
    }
    /* ROLES PAGE - UNLOCK ROLE */
    public function postRolesUnlockPage($id)
    {
        $role = Role::find($id);
        $role->deleted_at = null;
        $role->save();

        // redirect
        return Redirect::to('/backend/roles')->with('succes_box_message','De rol werd ongrendeld!');
    }
    /* ROLES PAGE - DELETE ROLE */
    public function postRolesDeletePage($id)
    {
        $role = Role::find($id);
        $users = User::all();

        foreach($users as $value)
        {
            if($value->hasRole($role->name))
            {
                //ROLE IS IN USE BY A USER
                return Redirect::to('/backend/roles')->with('error_box_message','De rol is in gebruik!');
            }
            else{
                //ROLE IS NOT IN USE BY A USER

                if(count($role->permissions) > 0)
                {
                    //ROLE HAS PERMISSIONS
                    return Redirect::to('/backend/roles')->with('error_box_message','De rol beschikt over gekoppelde toegangen!');
                }
                else{
                    $role->delete();
                }
            }
        }
        // redirect
        return Redirect::to('/backend/roles')->with('succes_box_message','De rol werd verwijderd!');
    }
    /* ROLES USERS PAGE */
    public function getUsersRolesPage(){

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET USERS */
        $users = User::with('roles')->get();

        /* GET ROLES */
        $roles = Role::with('permissions')->get();

        /* GET PERMISSIONS */
        $permissions = Permission::all();

        /* GET PERMISSIONS-CATEGOROES */
        $permission_categories = PermissionCategory::all();

        return view('backend.dashboard.roles_permissions.users-roles.users-roles',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'users' => $users,
                'roles' => $roles,
                'permissions' => $permissions,
                'permission_categories' => $permission_categories,
            ]);
    }
    /* ROLES USERS PAGE - LINK USER - ROL*/
    public function getUsersRolesLinkPage(){

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $users = ['0' => '-- Kies een gebruiker --'] + User::pluck('name', 'id')->toArray();

        $roles = ['0' => '-- Kies een gebruikersrol --'] + Role::pluck('name', 'id')->toArray();

        return view('backend.dashboard.roles_permissions.users-roles.users-roles_link',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'users' => $users,
                'roles' => $roles,
            ]);
    }
    /* ROLES USERS PAGE - POST LINK USER - ROL*/
    public function postUsersRolesLinkPage()
    {
        $data = Input::all();

        $rules = array(
            'role' => 'required|not_in:0',
            'user' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/users-roles/link')->withErrors($validator)->withInput();
        }

        //FIND RELATED ROLE WITH PERMISSION
        $role = Role::find($data['role']);
        $user = User::find($data['user']);

        //DETACH PERMISSION OF ROLE
        $user->attachRole($role);

        return Redirect::to('/backend/users-roles')->with('succes_box_message','Rol werd succesvol gekoppeld aan de gebruiker!');
    }
    /* ROLES USERS PAGE - EDIT USER - ROL*/
    public function getUsersRolesEditPage($role_id, $user_id)
    {

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $roles = ['0' => '-- Kies een gebruikersrol --'] + Role::pluck('name', 'id')->toArray();

        $users = ['0' => '-- Kies een gebruiker --'] + User::pluck('name', 'id')->toArray();

        return view('backend.dashboard.roles_permissions.users-roles.users-roles_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'roles' => $roles,
                'role_id' => $role_id,
                'users' => $users,
                'user_id' => $user_id,
            ]);
    }
    /* ROLES USERS PAGE - POST EDIT USER - ROL*/
    public function postUsersRolesEditPage($role_id, $user_id)
    {

        $data = Input::all();

        $rules = array(
            'role' => 'required|not_in:0',
            'user' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/users-roles/'.$role_id.'/'.$user_id.'/edit')->withErrors($validator)->withInput();
        }

        //FIND OLD RELATED ROLE WITH USER
        $old_role = Role::find($role_id);
        $old_user = User::find($user_id);

        //DETACH OLD ROLE OF USER
        $old_user->detachRole($old_role);

        //FIND NEW RELATED ROLE WITH USER
        $new_role = Role::find($data['role']);
        $new_user = User::find($data['user']);

        //ATTACH NEW ROLE OF USER
        $new_user->attachRole($new_role);

        return Redirect::to('/backend/users-roles')->with('succes_box_message','Gebruikersrol werd succesvol gewijzigd!');
    }
    /* ROLES USERS PAGE - LOCK ROLE */
    public function postUsersRolesLockPage($id)
    {
        $now = date('Y-m-d H:i:s');

        $role = Role::find($id);
        $role->deleted_at = $now;
        $role->save();

        // redirect
        return Redirect::to('/backend/users-roles')->with('succes_box_message','De rol werd vergrendeld!');
    }
    /* ROLES USERS PAGE - UNLOCK ROLE */
    public function postUsersRolesUnlockPage($id)
    {
        $role = Role::find($id);
        $role->deleted_at = null;
        $role->save();

        // redirect
        return Redirect::to('/backend/users-roles')->with('succes_box_message','De rol werd ongrendeld!');
    }
    /* ROLES USERS PAGE - DELETE ROLE */
    public function postUsersRolesDeletePage($role_id, $user_id)
    {
        //FIND ROLE AND USER
        $role = Role::find($role_id);
        $user = User::find($user_id);

        //DETACH ROLE OF USER
        $user->detachRole($role);

        // redirect
        return Redirect::to('/backend/users-roles')->with('succes_box_message','De rol werd verwijderd!');
    }

}

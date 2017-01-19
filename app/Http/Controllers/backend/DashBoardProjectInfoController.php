<?php namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Models\PageItem;
use App\Models\PageSubItem;
use App\Models\PageSubSubItem;
use App\Models\Role;
use App\Models\WidgetItem;
use App\Models\WidgetSubItem;
use App\Models\WidgetSubSubItem;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Models\MenuCategorie;
use App\Models\ProjectInfo;
use App\Models\MenuItem;
use App\Models\MenuSubItem;
use App\Models\MenuSubSubItem;
use App\Models\ToDoList;

use Validator;
use Auth;
use Mail;

class DashBoardUSerController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*------------ DashBoard - USERS ------------*/
    /* GET USER PAGE */
    public function getDashBoardUser()
    {
        /* GET PROJECT DATA */
        $project_data = ProjectInfo::first();

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET ALL USERS */
        $users = User::all();

        return view('backend.dashboard.users.index',
            [
                /* GENERAL */
                'project_data' => $project_data,
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'users' => $users,

            ]);
    }
    /* USERS PAGE - EDIT USER */
    public function getUserEditPage($id)
    {
        /* GET PROJECT DATA */
        $project_data = ProjectInfo::first();

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET USER */
        $user = User::find($id);

        //IF URL HAS ID NOT EXISTING IN DB - REDIRECT
        if(count($user) == null)
        {
            return Redirect::to('/backend/users')->with('error_box_message','Geen resultaten gevonden!');
        }

        return view('backend.dashboard.users.users_edit',
            [
                /* GENERAL */
                'project_data' => $project_data,
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'user' => $user,
            ]);
    }
    /* USERS PAGE - POST EDIT USER */
    public function postUserEditPage($id)
    {
        $data = Input::all();

        $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|email',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/user/'.$id.'/edit')->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        $user->save();

        return Redirect::to('/backend/users')->with('succes_box_message','De gebruiker werd aangepast!');
    }
    /* USERS PAGE - EDIT USER PASSWORD */
    public function getUserEditPasswordPage($id)
    {
        /* GET PROJECT DATA */
        $project_data = ProjectInfo::first();

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET USER */
        $user = User::find($id);

        //IF URL HAS ID NOT EXISTING IN DB - REDIRECT
        if(count($user) == null)
        {
            return Redirect::to('/backend/users')->with('error_box_message','Geen resultaten gevonden!');
        }

        return view('backend.dashboard.users.users_edit_password',
            [
                /* GENERAL */
                'project_data' => $project_data,
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'user' => $user,
            ]);
    }
    /* USERS PAGE - POST EDIT USER PASSWORD */
    public function postUserEditPasswordPage($id)
    {
        $data = Input::all();

        $rules = array(
            'password' => 'required|min:6|confirmed',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/user/'.$id.'/edit_password')->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->password = bcrypt($data['password']);

        $user->save();

        return Redirect::to('/backend/users')->with('succes_box_message','Het wachtwoord van de gebruiker werd aangepast!');
    }
    /* USERS PAGE - LOCK USER */
    public function postUserLockPage($id)
    {
        $now = date('Y-m-d H:i:s');

        $user = User::find($id);
        $user->deleted_at = $now;
        $user->save();

        // redirect
        return Redirect::to('/backend/users')->with('succes_box_message','De gebruiker is vergrendeld!');
    }
    /* USERS PAGE - UNLOCK USER */
    public function postUserUnlockPage($id)
    {
        $user = User::find($id);
        $user->deleted_at = null;
        $user->save();

        // redirect
        return Redirect::to('/backend/users')->with('succes_box_message','De gebruiker is ongrendeld!');
    }
    /* USERS PAGE - DELETE USER */
    public function postUserDeletePage($id)
    {
        $user = User::with('roles')->find($id);

        if(isset($user->roles->first()->name))
        {
            return Redirect::to('/backend/users')->with('error_box_message','De gebruiker beschikt over één of meerdere rollen!');
        }
        else{
            $user->delete();
            return Redirect::to('/backend/users')->with('succes_box_message','De gebruiker werd verwijderd!');
        }
    }
}

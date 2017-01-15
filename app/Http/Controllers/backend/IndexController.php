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

class IndexController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /* REGISTER ADMIN VIEW */
    public function getRegisterAdmin(){

        $roles = Role::pluck('name', 'id');

        return view('auth.register',
        [
            'roles' => $roles
        ]);
    }
    /* REGISTER ADMIN VIEW POST */
    public function postRegisterAdmin(){

        $data = Input::all();

        $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/register_admin')->withErrors($validator)->withInput();
        }

        $user = New User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();

        $role = Role::findOrFail($data['role']);
        $user->attachRole($role);

        return Redirect::to('/login');
    }

    public function index()
    {

        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEMS WITH SUB MENU ITEMS */
        $menu_items = MenuItem::with('menu_sub_items')->first();
        $menu_items_all = MenuItem::with('menu_sub_items')->get();

        /* GET SUB MENU ITEMS */
        $menu_sub_items = MenuSubItem::with('widget_sub_items')->orderBy('updated_at','DESC')->get();

        /* GET SUB SUB MENU ITEMS */
        $menu_sub_sub_items = MenuSubSubItem::with('widget_sub_sub_items')->orderBy('updated_at','DESC')->get();

        /* GET PAGE ITEMS FROM MENU ITEMS */
        $page_items = MenuItem::with('page_items')->get();

        /* GET SUB PAGE ITEMS FROM SUB MENU ITEMS */
        $page_sub_items = MenuSubItem::get();

        /* GET WIDGETS */
        $widget_items = WidgetItem::orderBy('updated_at','DESC')->get();

        /* GET SUB WIDGETS */
        $sub_widget_items = WidgetSubItem::orderBy('updated_at','DESC')->get();

        /* GET SUB SUBWIDGETS */
        $sub_sub_widget_items = WidgetSubSubItem::orderBy('updated_at','DESC')->get();

        /* GET VISIBILITY ITEMS */
        $visibility_items = VisibilityItem::get();

        $page_specialiteiten = MenuItem::with('page_items')->where('id','=','2')->where('status','=',1)->first();
        $page_workflow = MenuItem::with('page_items')->where('id','=','3')->where('status','=',1)->first();
        $page_projecten = MenuItem::with('page_items')->where('id','=','4')->where('status','=',1)->first();
        $page_contact = MenuItem::with('page_items')->where('id','=','5')->where('status','=',1)->first();

        /* TO DO LIST */
        $toDoList = ToDoList::orderBy('created_at', 'DESC')->paginate(5);

        return view('backend.index',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,
                'menu_items' => $menu_items,
                'menu_items_all' => $menu_items_all,
                'menu_sub_items' => $menu_sub_items,
                'menu_sub_sub_items' => $menu_sub_sub_items,
                'page_items' => $page_items,
                'page_sub_items' => $page_sub_items,
                'widget_items' => $widget_items,
                'sub_widget_items' => $sub_widget_items,
                'sub_sub_widget_items' => $sub_sub_widget_items,
                'visibility_items' => $visibility_items,

                /* DATA PAGES */
                'page_specialiteiten' => $page_specialiteiten,
                'page_workflow' => $page_workflow,
                'page_projecten' => $page_projecten,
                'page_contact' => $page_contact,

                /* TO DO LIST */
                'toDoList' => $toDoList,

            ]);
    }
    //GET OVERVIEW ALL SUBPAGES - Niveau 2
    public function getSubPageOverview(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->orderBy('rank')->get();

        return view('backend.dashboard.pages.sub_page_overview',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items

            ]);
    }
    //GET OVERVIEW ALL SUB SUBPAGES - Niveau 3
    public function getSubSubPageOverview(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->orderBy('rank')->get();

        $menu_sub_items = MenuSubItem::with('menu_sub_sub_items')->orderBy('rank')->get();

        return view('backend.dashboard.pages.sub_sub_page_overview',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,
                'menu_sub_items' => $menu_sub_items

            ]);
    }
    //GET OVERVIEW ALL WIDGETS - Niveau 1
    public function getWidgetOverview(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('widget_items')->orderBy('rank')->get();

        return view('backend.dashboard.pages.widget_overview',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items

            ]);
    }
    //GET OVERVIEW ALL SUBWIDGETS - Niveau 2
    public function getSubWidgetOverview(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->orderBy('rank')->get();

        $menu_sub_items = MenuSubItem::with('widget_sub_items')->orderBy('rank')->get();

        return view('backend.dashboard.pages.sub_widget_overview',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,
                'menu_sub_items' => $menu_sub_items

            ]);
    }
    //GET OVERVIEW ALL SUB SUBWIDGETS - Niveau 3
    public function getSubSubWidgetOverview(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->orderBy('rank')->get();

        $menu_sub_items = MenuSubItem::with('widget_sub_items')->orderBy('rank')->get();

        $menu_sub_sub_items = MenuSubSubItem::with('widget_sub_sub_items')->orderBy('rank')->get();

        return view('backend.dashboard.pages.sub_sub_widget_overview',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,
                'menu_sub_items' => $menu_sub_items,
                'menu_sub_sub_items' => $menu_sub_sub_items

            ]);
    }
    //GET VIEW PAGE - Niveau 1
    public function getNewPage(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        return view('backend.dashboard.pages.page_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,
            ]);
    }
     //POST NEW SUB - Niveau 1
    public function postNewPage(){

        //GET VALUE BUTTON SUBMIT
        $button = Input::get('aanmaken');

        $rules = array(
            'titel'  => 'required|max:20',
            'optionsVisibility'  => 'required',
            'optionsSubpage'  => 'required',
            'optionsWidget'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/new_page')->withErrors($validator)->withInput();
        }
        //CREATE NEW SUB SLUG
        $new_slug = str_slug(Input::get('titel'));

        //GET MAX RANK IF EXIST
        $menu_item_max_rank = MenuItem::orderBy('rank', 'DESC')->first();

        $new_menu_item = new MenuItem();
        $new_menu_item->menu_categorie_id = 1;
        $new_menu_item->title = Input::get('titel');
        $new_menu_item->slug = $new_slug;
        $new_menu_item->status = Input::get('optionsVisibility');
        //IF THERE IS NU MENU ITEM YET => RANK 1
        if($menu_item_max_rank == null)
        {
            $new_menu_item->rank = 1;
        }
        //ELSE RANK +1
        else{
            $new_menu_item->rank = $menu_item_max_rank->rank+1;
        }
        $new_menu_item->need_subpage = Input::get('optionsSubpage');
        $new_menu_item->need_widget = Input::get('optionsWidget');

        $new_menu_item->save();

        $new_page_menu = new PageItem();
        $new_page_menu->menu_item_id = $new_menu_item->id;
        $new_page_menu->body = Input::get('body');

        if($new_page_menu->save()){
            if($button == 'aanmaken')
            {
                return Redirect::to('backend')->with('succes_box_message','De pagina werd aangemaakt!');
            }
            else{
                return Redirect::to('backend/new_page')->with('succes_box_message','De pagina werd aangemaakt!');
            }
        }

        return Redirect::to('/backend/new_page')->with('error_message','Error!');
    }
    //GET VIEW NEW SUBPAGE WITHOUT ID => FILL DROPDOWN SELECT  - Niveau 2
    public function getNewSubPage(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items_list = MenuItem::where('need_subpage','=',1)->get();

        return view('backend.dashboard.pages.sub_page_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items_list' => $menu_items_list,
            ]);
    }
    //GET VIEW NEW SUBPAGE WITH ID => FILL DROPDOWN SELECT - Niveau 2
    public function getNewSubPageId($id){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items_list = MenuItem::where('need_subpage','=',1)->get();

        return view('backend.dashboard.pages.sub_page_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items_list' => $menu_items_list,
                'id' => $id

            ]);
    }
    //POST VIEW NEW SUBPAGE - Niveau 2
    public function postNewSubPage(){

        //GET VALUE BUTTON SUBMIT
        $button = Input::get('aanmaken');

        $rules = array(
            'hoofdpagina'  => 'required',
            'titel'  => 'required|max:20',
            'optionsVisibility'  => 'required',
            'optionsSubSubpage'  => 'required',
            'optionsWidget'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/new_sub_page_2')->withErrors($validator)->withInput();
        }
        //CREATE NEW SUB SLUG
        $new_slug = str_slug(Input::get('titel'));

        //GET MAX RANK
        $sub_menu_item_max_rank = MenuSubItem::orderBy('rank', 'DESC')->first();

        $new_sub_menu_item = new MenuSubItem();
        $new_sub_menu_item->menu_item_id = Input::get('hoofdpagina');
        $new_sub_menu_item->title = Input::get('titel');
        $new_sub_menu_item->slug = $new_slug;
        $new_sub_menu_item->status = Input::get('optionsVisibility');
        //IF THERE IS NO SUB MENU ITEM YET => RANK 1
        if($sub_menu_item_max_rank == null)
        {
            $new_sub_menu_item->rank = 1;
        }
        //ELSE RANK +1
        else{
            $new_sub_menu_item->rank = $sub_menu_item_max_rank->rank+1;
        }
        $new_sub_menu_item->need_sub_subpage = Input::get('optionsSubSubpage');
        $new_sub_menu_item->need_sub_widget = Input::get('optionsWidget');

        $new_sub_menu_item->save();

        $new_page_sub_menu = new PageSubItem();
        $new_page_sub_menu->menu_sub_item_id = $new_sub_menu_item->id;
        $new_page_sub_menu->body = Input::get('body');

        if($new_page_sub_menu->save()){
            if($button == 'aanmaken')
            {
                return Redirect::to('backend')->with('succes_box_message','De subpagina werd aangemaakt!');
            }
            else{
                return Redirect::to('backend/new_sub_page_2')->with('succes_box_message','De subpagina werd aangemaakt!');
            }
        }

        return Redirect::to('/backend/new_sub_page_2')->with('error_message','Error!');
    }
    //GET VIEW NEW SUBPAGE WITHOUT ID => FILL DROPDOWN SELECT - Niveau 3
    public function getNewSubSubPage(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->where('need_subpage','=',1)->get();

        return view('backend.dashboard.pages.sub_sub_page_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,

            ]);
    }
    //GET VIEW NEW SUBPAGE WITH ID => FILL DROPDOWN SELECT - Niveau 3
    public function getNewSubSubPageId($id){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->where('need_subpage','=',1)->get();

        return view('backend.dashboard.pages.sub_sub_page_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,
                'id' => $id

            ]);
    }
    //POST VIEW NEW SUBPAGE - Niveau 3
    public function postNewSubSubPage(){

        //GET VALUE BUTTON SUBMIT
        $button = Input::get('aanmaken');

        $rules = array(
            'subpagina'  => 'required',
            'titel'  => 'required|max:20',
            'optionsVisibility'  => 'required',
            'optionsWidget'  => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/new_sub_page_3')->withErrors($validator)->withInput();
        }
        //CREATE NEW SUB SLUG
        $new_slug = str_slug(Input::get('titel'));

        //GET MAX RANK
        $sub_menu_item_max_rank = MenuSubSubItem::orderBy('rank', 'DESC')->first();

        $new_sub_sub_menu_item = new MenuSubSubItem();
        $new_sub_sub_menu_item->menu_sub_item_id = Input::get('subpagina');
        $new_sub_sub_menu_item->title = Input::get('titel');
        $new_sub_sub_menu_item->slug = $new_slug;
        $new_sub_sub_menu_item->status = Input::get('optionsVisibility');
        //IF THERE IS NO SUB SUB MENU ITEM YET => RANK 1
        if($sub_menu_item_max_rank == null)
        {
            $new_sub_sub_menu_item->rank = 1;
        }
        //ELSE RANK +1
        else{
            $new_sub_sub_menu_item->rank = $sub_menu_item_max_rank->rank+1;
        }

        $new_sub_sub_menu_item->need_sub_sub_widget = Input::get('optionsWidget');

        $new_sub_sub_menu_item->save();

        $new_page_sub_sub_menu = new PageSubSubItem();
        $new_page_sub_sub_menu->menu_sub_sub_item_id = $new_sub_sub_menu_item->id;
        $new_page_sub_sub_menu->body = Input::get('body');

        if($new_page_sub_sub_menu->save()){
            if($button == 'aanmaken')
            {
                return Redirect::to('backend')->with('succes_box_message','De subpagina werd aangemaakt!');
            }
            else{
                return Redirect::to('backend/new_sub_page_3')->with('succes_box_message','De subpagina werd aangemaakt!');
            }
        }

        return Redirect::to('/backend/new_sub_page_3')->with('error_message','Error!');
    }
    //GET VIEW NEW WIDGET WITHOUT ID - Niveau 1
    public function getNewWidget(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items_list = MenuItem::where('need_subpage','=',1)->get();

        return view('backend.dashboard.pages.widget_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items_list' => $menu_items_list

            ]);
    }
    //GET VIEW NEW WIDGET WITH ID => FILL DROPDOWN SELECT - Niveau 1
    public function getNewWidgetId($id){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items_list = MenuItem::where('need_subpage','=',1)->get();

        return view('backend.dashboard.pages.widget_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items_list' => $menu_items_list,
                'id' => $id
            ]);
    }
    //POST VIEW NEW WIDGET - Niveau 1
    public function postNewWidget(){

        //GET VALUE BUTTON SUBMIT
        $button = Input::get('aanmaken');

        $rules = array(
            'hoofdpagina'  => 'required',
            'titel'  => 'required|max:20',
            'description'  => 'required',
            'icon'  => 'required',
            'extra'  => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/new_widget')->withErrors($validator)->withInput();
        }

//        $widget_item_rank = WidgetItem::orderBy('rank', 'DESC')->first();

        $widget_item = new WidgetItem();
        $widget_item->title = Input::get('titel');
        $widget_item->description = Input::get('description');
        $widget_item->icon = Input::get('icon');
        $widget_item->extra = Input::get('extra');
        $widget_item->menu_item_id = Input::get('hoofdpagina');

        if($widget_item->save()){
            if($button == 'aanmaken')
            {
                return Redirect::to('backend')->with('succes_box_message','Nieuwe widget aangemaakt!');
            }
            else{
                return Redirect::to('backend/new_widget')->with('succes_box_message','Nieuwe widget aangemaakt!');
            }
        }
        return Redirect::to('/backend/new_widget')->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }
    //GET VIEW NEW SUB WIDGET WITHOUT ID - Niveau 2
    public function getNewSubWidget(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->get();

        return view('backend.dashboard.pages.sub_widget_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items

            ]);
    }
    //GET VIEW NEW SUB WIDGET WITH ID => FILL DROPDOWN SELECT - Niveau 2
    public function getNewSubWidgetId($id){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->get();

        return view('backend.dashboard.pages.sub_widget_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,
                'id' => $id
            ]);
    }
    //POST VIEW NEW SUB WIDGET - Niveau 2
    public function postNewSubWidget(){

        //GET VALUE BUTTON SUBMIT
        $button = Input::get('aanmaken');

        $rules = array(
            'subpagina'  => 'required',
            'titel'  => 'required|max:20',
            'description'  => 'required',
            'icon'  => 'required',
            'extra'  => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/new_sub_widget_2')->withErrors($validator)->withInput();
        }

//        $widget_item_rank = WidgetItem::orderBy('rank', 'DESC')->first();

        $widget__sub_item = new WidgetSubItem();
        $widget__sub_item->title = Input::get('titel');
        $widget__sub_item->description = Input::get('description');
        $widget__sub_item->icon = Input::get('icon');
        $widget__sub_item->extra = Input::get('extra');
        $widget__sub_item->menu_sub_item_id = Input::get('subpagina');

        if($widget__sub_item->save()){
            if($button == 'aanmaken')
            {
                return Redirect::to('backend')->with('succes_box_message','Nieuwe widget aangemaakt!');
            }
            else{
                return Redirect::to('backend/new_sub_widget_2')->with('succes_box_message','Nieuwe widget aangemaakt!');
            }
        }
        return Redirect::to('/backend/new_sub_widget_2')->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }

    //GET VIEW NEW SUB WIDGET WITHOUT ID - Niveau 3
    public function getNewSubSubWidget(){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->get();

        return view('backend.dashboard.pages.sub_sub_widget_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items

            ]);
    }
    //GET VIEW NEW SUB WIDGET WITH ID => FILL DROPDOWN SELECT - Niveau 3
    public function getNewSubSubWidgetId($id){
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        $menu_items = MenuItem::with('menu_sub_items')->get();

        return view('backend.dashboard.pages.sub_sub_widget_create',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* DATA */
                'menu_items' => $menu_items,
                'id' => $id
            ]);
    }
    //POST VIEW NEW SUB WIDGET - Niveau 3
    public function postNewSubSubWidget(){

        //GET VALUE BUTTON SUBMIT
        $button = Input::get('aanmaken');

        $rules = array(
            'subSubpagina'  => 'required',
            'titel'  => 'required|max:20',
            'description'  => 'required',
            'icon'  => 'required',
            'extra'  => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/new_sub_widget_3')->withErrors($validator)->withInput();
        }

//        $widget_item_rank = WidgetItem::orderBy('rank', 'DESC')->first();

        $widget_sub_sub_item = new WidgetSubSubItem();
        $widget_sub_sub_item->title = Input::get('titel');
        $widget_sub_sub_item->description = Input::get('description');
        $widget_sub_sub_item->icon = Input::get('icon');
        $widget_sub_sub_item->extra = Input::get('extra');
        $widget_sub_sub_item->menu_sub_sub_item_id = Input::get('subSubpagina');

        if($widget_sub_sub_item->save()){
            if($button == 'aanmaken')
            {
                return Redirect::to('backend')->with('succes_box_message','Nieuwe widget aangemaakt!');
            }
            else{
                return Redirect::to('backend/new_sub_widget_3')->with('succes_box_message','Nieuwe widget aangemaakt!');
            }
        }
        return Redirect::to('/backend/new_sub_widget_3')->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }

    public function index_preview() {

        return view('backend.preview.index');
    }

    public function postToDo()
    {
        $rules = array(
            'item'  => 'required|min:3|max:255',
        );
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/')->withErrors($validator)->withInput();
        }
        $toDO = new ToDoList();
        $toDO->item = Input::get('item');

        if($toDO->save()){
            return Redirect::to('/backend/')->with('to_do_message','Nieuw item toegevoegd!');
        }

        return Redirect::to('/backend/')->with('error_message','Error!');

    }
    public function postDelete($id)
    {
        $toDO = ToDoList::find($id);

        $toDO->delete();

        // redirect
        return Redirect::to('/backend/')->with('to_do_message','Item is verwijderd!');

    }
    public function postUpdateTextField()
    {
        $value = $_POST['value'];
        $id = $_POST['pk'];

        $todo = ToDoList::find($id);
        $todo->item = $value;
        $todo->updated_at = date('Y-m-d H:i:s');
        $todo->save();
    }
    public function postProblemContact()
    {
        //Get all Data
        $data = Input::all();

        //email user logged in
        $email = Auth::user()->email;

        $rules = array (
            'subject' => 'required',
            'bericht' => 'required',
        );

        //Validate data
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        //If everything is correct than run passes.
        //SEND MAIL TO ADMIN
        Mail::send('backend.emails.contact_problem.contact_admin', ['data' => $data, 'email' => $email] , function($message){
            $message->to('stijn@vdk-design.be');
            $message->subject('Probleem request');
        });

        //SEND MAIL TO CLIENT
        Mail::send('backend.emails.contact_problem.contact_client', ['data' => $data, 'email' => $email] , function($message) use ($data, $email){
            $message->to($email);
            $message->subject('Probleem request');
        });

        //        return Redirect::to('/backend/')->with('email_error','Error!');
        return Redirect::to('/backend/')->with('email_message','E-mail verzonden!');
    }

}

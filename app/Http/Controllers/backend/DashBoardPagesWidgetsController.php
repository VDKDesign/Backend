<?php namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Models\PageItem;
use App\Models\PageSubItem;
use App\Models\PageSubSubItem;
use App\Models\WidgetItem;
use App\Models\WidgetSubItem;
use App\Models\WidgetSubSubItem;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\Models\MenuCategorie;
use App\Models\MenuItem;
use App\Models\MenuSubItem;
use App\Models\MenuSubSubItem;
use App\Models\ToDoList;

use Validator;
use Auth;
use Mail;

class DashBoardPagesWidgetsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*------------ DashBoard - PAGES ------------*/

    /* GET MENU ITEM - PAGE - NIVEAU 1 */
    public function getDashBoardMenuPage($slug)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM WITH CONTENT */
        $menu_item = MenuItem::where('slug','=', $slug)->with('page_items')->first();

        //GET ALL MENU ITEMS BY RANK
        $menu_items = MenuItem::orderBy('rank', 'ASC')->get();

        if(count($menu_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.pages.page_edit',
        [
            /* GENERAL */
            'menu_categorie' => $menu_categorie,

            /* CONTENT */
            'menu_item' =>  $menu_item,
            'menu_items' =>  $menu_items,
        ]);
    }

    /* GET SUB MENU ITEM - SUBPAGE - NIVEAU 2 */
    public function getDashBoardMenuSubPage($slug, $sub_slug)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM */
        $menu_item = MenuItem::where('slug','=', $slug)->first();

        //GET ALL SUB MENU ITEMS BY RANK
        $menu_sub_items = MenuSubItem::where('menu_item_id','=',$menu_item->id)->orderBy('rank', 'ASC')->get();

        /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_item = MenuSubItem::where('slug','=', $sub_slug)->where('menu_item_id','=',$menu_item->id)->with('page_sub_items')->first();

        if(count($menu_sub_item) == null)
        {
            return Redirect::to('/backend/page/'.$slug);
        }

        return view('backend.dashboard.pages.sub_page_edit',
        [
            /* GENERAL */
            'menu_categorie' => $menu_categorie,

            /* CONTENT */
            'menu_item' =>  $menu_item,
            'menu_sub_item' =>  $menu_sub_item,
            'menu_sub_items' => $menu_sub_items,
        ]);
    }

    /* GET SUB SUB MENU ITEM - SUBSUBPAGE - NIVEAU 3 */
    public function getDashBoardMenuSubSubPage($slug, $sub_slug, $sub_sub_slug)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM */
        $menu_item = MenuItem::where('slug','=', $slug)->first();

        /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_item = MenuSubItem::where('slug','=', $sub_slug)->where('menu_item_id','=',$menu_item->id)->with('page_sub_items')->first();

        //GET ALL SUB MENU ITEMS BY RANK
        $menu_sub_sub_items = MenuSubSubItem::where('menu_sub_item_id','=',$menu_sub_item->id)->orderBy('rank', 'ASC')->get();

         /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_sub_item = MenuSubSubItem::where('slug','=', $sub_sub_slug)->where('menu_sub_item_id','=',$menu_sub_item->id)->with('page_sub_sub_items')->first();

        if(count($menu_sub_item) == null)
        {
            return Redirect::to('/backend/page/'.$slug);
        }

        return view('backend.dashboard.pages.sub_sub_page_edit',
        [
            /* GENERAL */
            'menu_categorie' => $menu_categorie,

            /* CONTENT */
            'menu_item' =>  $menu_item,
            'menu_sub_item' =>  $menu_sub_item,
            'menu_sub_sub_item' => $menu_sub_sub_item,
            'menu_sub_sub_items' => $menu_sub_sub_items,

        ]);
    }

    /*------------ DashBoard - PAGES - CRUD ------------*/

    /* EDIT MENU ITEM - PAGE - NIVEAU 1 */
    public function postDashBoardMenuItemEdit($slug, $id)
    {
        $rules = array(
            'title'  => 'required|max:20',
            'optionsVisibility'  => 'required',
            'rank' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/page/'.$slug)->withErrors($validator);
        }

        //CREATE NEW SLUG
        $new_slug = str_slug(Input::get('title'));

        $menuItem = MenuItem::find($id);
        $menuItem->title = Input::get('title');
        $menuItem->status = Input::get('optionsVisibility');

        //GET OLD & NEW RANK
        $new_rank = Input::get('rank');

        //GET OLD ITEM MENU
        $menuItem_old = MenuItem::where('rank', '=', $new_rank)->first();
        $menuItem_old->rank = $menuItem->rank;
        $menuItem_old->save();

        //REPLACE NEM RANK
        $menuItem->rank = $new_rank;

        $menuItem->slug = $new_slug;

        $pageItem = PageItem::where('menu_item_id','=',$menuItem->id)->first();
        $pageItem->body = Input::get('body');

        if($menuItem->save() && $pageItem->save()){
            return Redirect::to('backend/page/'.$new_slug)->with('succes_box_message','De pagina werd gewijzigd!');
        }

        return Redirect::to('backend/page/'.$new_slug)->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }

    /* EDIT SUB MENU ITEM - SUBPAGE - NIVEAU 2 */
    public function postDashBoardMenuSubItemEdit($slug, $sub_slug, $id)
    {
        $rules = array(
            'title'  => 'required|max:20',
            'optionsVisibility'  => 'required',
            'rank' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/subpage_2/'.$slug.'/'.$sub_slug)->withErrors($validator);
        }

        //CREATE NEW SUB SLUG
        $new_slug = str_slug(Input::get('title'));

        $menuSubItem = MenuSubItem::find($id);
        $menuSubItem->title = Input::get('title');
        $menuSubItem->status = Input::get('optionsVisibility');

        //GET OLD & NEW RANK
        $new_rank = Input::get('rank');

        //GET OLD ITEM MENU
        $menuSubItem_old = MenuSubItem::where('rank', '=', $new_rank)->first();
        $menuSubItem_old->rank = $menuSubItem->rank;
        $menuSubItem_old->save();

        //REPLACE NEM RANK
        $menuSubItem->rank = $new_rank;

        $menuSubItem->slug = $new_slug;

        $pageSubItem = PageSubItem::where('menu_sub_item_id','=',$menuSubItem->id)->first();

         if($pageSubItem == null)
        {
            $pageSubItem = new PageSubItem();
            $pageSubItem->menu_sub_item_id = $menuSubItem->id;
            $pageSubItem->body = Input::get('body');
        }
        else{
            $pageSubItem->body = Input::get('body');
        }

        if($menuSubItem->save() && $pageSubItem->save()){
            return Redirect::to('backend/subpage_2/'.$slug.'/'.$new_slug)->with('succes_box_message','De subpagina werd gewijzigd!');
        }

        return Redirect::to('backend/subpage_2/'.$slug.'/'.$new_slug)->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }
    /* EDIT SUB SUBMENU ITEM - SUB SUBPAGE - NIVEAU 3 */
    public function postDashBoardMenuSubSubItemEdit($slug, $sub_slug, $sub_sub_slug, $id)
    {
        $rules = array(
            'title'  => 'required|max:20',
            'optionsVisibility'  => 'required',
            'rank' => 'required|not_in:0',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/subpage_3/'.$slug.'/'.$sub_slug.'/'.$sub_sub_slug)->withErrors($validator);
        }

        //CREATE NEW SUB SLUG
        $new_slug = str_slug(Input::get('title'));

        $menuSubSubItem = MenuSubSubItem::find($id);
        $menuSubSubItem->title = Input::get('title');
        $menuSubSubItem->status = Input::get('optionsVisibility');

        //GET OLD & NEW RANK
        $new_rank = Input::get('rank');

        //GET OLD ITEM MENU
        $menuSubSubItem_old = MenuSubSubItem::where('rank', '=', $new_rank)->first();
        $menuSubSubItem_old->rank = $menuSubSubItem->rank;
        $menuSubSubItem_old->save();

        //REPLACE NEM RANK
        $menuSubSubItem->rank = $new_rank;

        $menuSubSubItem->slug = $new_slug;

        $pageSubSubItem = PageSubSubItem::where('menu_sub_sub_item_id','=',$menuSubSubItem->id)->first();

        if($pageSubSubItem == null)
        {
            $pageSubSubItem = new PageSubSubItem();
            $pageSubSubItem->menu_sub_sub_item_id = $menuSubSubItem->id;
            $pageSubSubItem->body = Input::get('body');
        }
        else{
            $pageSubSubItem->body = Input::get('body');
        }


        if($menuSubSubItem->save() && $pageSubSubItem->save()){
            return Redirect::to('backend/subpage_3/'.$slug.'/'.$sub_slug.'/'.$new_slug)->with('succes_box_message','De subpagina werd gewijzigd!');
        }

        return Redirect::to('backend/subpage_3/'.$slug.'/'.$sub_slug.'/'.$new_slug)->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }
    /*------------ DashBoard - WIDGETS - PAGE ------------*/

    /* WIDGET - PAGE - NIVEAU 1 */
    public function getWidgetPage($slug)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM WITH CONTENT */
        $menu_item = MenuItem::where('slug','=', $slug)->with('widget_items')->first();

        if(count($menu_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.widgets.page',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'menu_item' =>  $menu_item,

            ]);
    }

    /* WIDGET - DETAILS - NIVEAU 1 */
    public function getWidgetPageDetails($slug, $id)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM WITH CONTENT */
        $menu_item = MenuItem::where('slug','=', $slug)->with('widget_items')->first();

        /* GET WIDGET WITH CONTENT */
        $widget_item = WidgetItem::find($id);

        if(count($menu_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.widgets.page_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'menu_item' =>  $menu_item,
                'widget_item' =>  $widget_item,

            ]);
    }

    /* WIDGET - DETAILS - EDIT - NIVEAU 1 */
    public function getWidgetPageDetailsEdit($slug, $id)
    {
        $rules = array(
            'title'  => 'required|max:20',
            'description'  => 'required',
            'icon'  => 'required',
            'extra'  => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/widget/'.$slug.'/details/'.$id)->withErrors($validator);
        }

        $widgetItem = WidgetItem::find($id);
        $widgetItem->title = Input::get('title');
        $widgetItem->description = Input::get('description');
        $widgetItem->icon = Input::get('icon');
        $widgetItem->extra = Input::get('extra');

        if($widgetItem->save()){
            return Redirect::to('/backend/widget/'.$slug.'/details/'.$id)->with('succes_box_message','De widget werd gewijzigd!');
        }

        return Redirect::to('/backend/widget/'.$slug.'/details/'.$id)->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }

    /* SUB WIDGET PAGE - NIVEAU 2 */
    public function getWidgetSubPage($slug, $sub_slug)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM */
        $menu_item = MenuItem::where('slug','=', $slug)->with('widget_items')->first();

        /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_item = MenuSubItem::where('slug','=', $sub_slug)->with('widget_sub_items')->first();

        if(count($menu_sub_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.widgets.sub_page',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'menu_item' =>  $menu_item,
                'menu_sub_item' =>  $menu_sub_item,

            ]);
    }

    /* SUB WIDGET - DETAILS - NIVEAU 2 */
    public function getWidgetSubPageDetails($slug, $sub_slug, $id)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM */
        $menu_item = MenuItem::where('slug','=', $slug)->with('widget_items')->first();

        /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_item = MenuSubItem::where('slug','=', $sub_slug)->with('widget_sub_items')->first();

        /* GET SUB WIDGET WITH CONTENT */
        $widget_sub_item = WidgetSubItem::find($id);

        if(count($menu_sub_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.widgets.sub_page_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'menu_item' =>  $menu_item,
                'menu_sub_item' =>  $menu_sub_item,
                'widget_sub_item' =>  $widget_sub_item,

            ]);
    }

    /* SUB WIDGET - DETAILS - EDIT - NIVEAU 2 */
    public function getWidgetSubPageDetailsEdit($slug, $sub_slug, $id)
    {
        $rules = array(
            'title'  => 'required|max:20',
            'description'  => 'required',
            'icon'  => 'required',
            'extra'  => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/subwidget/'.$slug.'/'.$sub_slug.'/details/'.$id)->withErrors($validator);
        }

        $widgetSubItem = WidgetSubItem::find($id);
        $widgetSubItem->title = Input::get('title');
        $widgetSubItem->description = Input::get('description');
        $widgetSubItem->icon = Input::get('icon');


        if($widgetSubItem->save()){
            return Redirect::to('/backend/subwidget_2/'.$slug.'/'.$sub_slug.'/details/'.$id)->with('succes_box_message','De subwidget werd gewijzigd!');
        }

        return Redirect::to('/backend/subwidget_2/'.$slug.'/'.$sub_slug.'/details/'.$id)->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }

    /* SUB WIDGET PAGE - NIVEAU 3 */
    public function getWidgetSubSubPage($slug, $sub_slug, $sub_sub_slug)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM */
        $menu_item = MenuItem::where('slug','=', $slug)->with('widget_items')->first();

        /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_item = MenuSubItem::where('slug','=', $sub_slug)->with('widget_sub_items')->first();

        /* GET SUBSUBMENU ITEM WITH CONTENT */
        $menu_sub_sub_item = MenuSubSubItem::where('slug','=', $sub_sub_slug)->with('widget_sub_sub_items')->first();

        if(count($menu_sub_sub_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.widgets.sub_sub_page',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'menu_item' =>  $menu_item,
                'menu_sub_item' =>  $menu_sub_item,
                'menu_sub_sub_item' =>  $menu_sub_sub_item,
            ]);
    }

    /* SUB WIDGET - DETAILS - NIVEAU 3 */
    public function getWidgetSubSubPageDetails($slug, $sub_slug, $sub_sub_slug, $id)
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        /* GET MENU ITEM */
        $menu_item = MenuItem::where('slug','=', $slug)->with('widget_items')->first();

        /* GET SUBMENU ITEM WITH CONTENT */
        $menu_sub_item = MenuSubItem::where('slug','=', $sub_slug)->with('widget_sub_items')->first();

        /* GET SUBSUBMENU ITEM WITH CONTENT */
        $menu_sub_sub_item = MenuSubSubItem::where('slug','=', $sub_sub_slug)->with('widget_sub_sub_items')->first();

        /* GET SUB WIDGET WITH CONTENT */
        $widget_sub_sub_item = WidgetSubSubItem::find($id);

        if(count($menu_sub_item) == null)
        {
            return Redirect::to('/backend');
        }

        return view('backend.dashboard.widgets.sub_sub_page_edit',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */
                'menu_item' =>  $menu_item,
                'menu_sub_item' =>  $menu_sub_item,
                'menu_sub_sub_item' =>  $menu_sub_sub_item,
                'widget_sub_sub_item' =>  $widget_sub_sub_item,

            ]);
    }

    /* SUB WIDGET - DETAILS - EDIT - NIVEAU 3 */
    public function getWidgetSubSubPageDetailsEdit($slug, $sub_slug, $sub_sub_slug, $id)
    {
        $rules = array(
            'title'  => 'required|max:20',
            'description'  => 'required',
            'icon'  => 'required',
            'extra'  => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails()){
            return Redirect::to('/backend/subwidget_3/'.$slug.'/'.$sub_slug.'/'.$sub_sub_slug.'/details/'.$id)->withErrors($validator);
        }

        $widgetSubSubItem = WidgetSubSubItem::find($id);
        $widgetSubSubItem->title = Input::get('title');
        $widgetSubSubItem->description = Input::get('description');
        $widgetSubSubItem->icon = Input::get('icon');


        if($widgetSubSubItem->save()){
            return Redirect::to('/backend/subwidget_3/'.$slug.'/'.$sub_slug.'/'.$sub_sub_slug.'/details/'.$id)->with('succes_box_message','De subwidget werd gewijzigd!');
        }

        return Redirect::to('/backend/subwidget_3/'.$slug.'/'.$sub_slug.'/'.$sub_sub_slug.'/details/'.$id)->with('error_box_message','Neem zo snel mogelijk contact op met de beheerder!');
    }


    /* WIDGET FAST EDIT - TITLE */
    public function postWidgetUpdateTitle()
    {
        $value = $_POST['value'];
        $id = $_POST['pk'];

        $widgetItem = WidgetItem::find($id);
        $widgetItem->title = $value;
        $widgetItem->updated_at = date('Y-m-d H:i:s');
        $widgetItem->save();
    }

    /* WIDGET FAST EDIT - DESCIPTION */
    public function postWidgetUpdateDescription()
    {
        $value = $_POST['value'];
        $id = $_POST['pk'];

        $widgetItem = WidgetItem::find($id);
        $widgetItem->description = $value;
        $widgetItem->updated_at = date('Y-m-d H:i:s');
        $widgetItem->save();
    }

    /* SUB WIDGET FAST EDIT - TITLE */
    public function postSubWidgetUpdateTitle()
    {
        $value = $_POST['value'];
        $id = $_POST['pk'];

        $widgetSubItem = WidgetSubItem::find($id);
        $widgetSubItem->title = $value;
        $widgetSubItem->updated_at = date('Y-m-d H:i:s');
        $widgetSubItem->save();
    }

    /* SUB WIDGET FAST EDIT - DESCIPTION */
    public function postSubWidgetUpdateDescription()
    {
        $value = $_POST['value'];
        $id = $_POST['pk'];

        $widgetSubItem = WidgetSubItem::find($id);
        $widgetSubItem->description = $value;
        $widgetSubItem->updated_at = date('Y-m-d H:i:s');
        $widgetSubItem->save();
    }
}

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

class DashBoardGalleryController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*------------ DashBoard - GALLERY ------------*/
    /* GET GALLERY */

    public function getDashBoardGallery()
    {
        /* GET HEAD CATEGORIE WITH MENU ITEMS */
        $menu_categorie = MenuCategorie::with('menu_items')->first();

        return view('backend.dashboard.gallery.index',
            [
                /* GENERAL */
                'menu_categorie' => $menu_categorie,

                /* CONTENT */

            ]);
    }
}

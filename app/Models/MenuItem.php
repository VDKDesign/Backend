<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'menu_items';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'status',
        'title',
        'url',
        'rank',
    ];

    // Get the Categorie that owns the Menu Item.
    public function menu_categorie()
    {
        return $this->belongsTo('App\Models\MenuCategorie');
    }

    // Get the Sub Menu Items for the Menu Items.
    public function menu_sub_items()
    {
        return $this->hasMany('App\Models\MenuSubItem')->orderBy('rank');
    }

    // Get the Page Items for the Item Menu.
    public function page_items()
    {
        return $this->hasMany('App\Models\PageItem');
    }

    // Get the Widget Items for the Item Menu.
    public function widget_items()
    {
        return $this->hasMany('App\Models\WidgetItem');
    }

}

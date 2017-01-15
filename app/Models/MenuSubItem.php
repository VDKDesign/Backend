<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuSubItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'menu_sub_items';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'status',
        'title',
        'url',
        'rank',
    ];

    // Get the Menu Item that owns the Sub Menu Item.
    public function menu_item()
    {
        return $this->belongsTo('App\Models\MenuItem');
    }
    // Get the Sub Menu Items for the Menu Items.
    public function menu_sub_sub_items()
    {
        return $this->hasMany('App\Models\MenuSubSubItem')->orderBy('rank');
    }
    // Get the Page Sub Items for the Sub Item Menu.
    public function page_sub_items()
    {
        return $this->hasMany('App\Models\PageSubItem');
    }

    // Get the Page Sub Items for the Sub Item Menu.
    public function widget_sub_items()
    {
        return $this->hasMany('App\Models\widgetSubItem');
    }

}

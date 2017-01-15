<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class WidgetSubItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'widget_sub_items';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'title',
        'description',
        'icon',
    ];

    // Get the Sub Item Menu that owns the Sub Page Item.
    public function menu_sub_item()
    {
        return $this->belongsTo('App\Models\MenuSubItem');
    }

}

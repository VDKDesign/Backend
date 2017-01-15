<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class WidgetItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'widget_items';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'menu_item_id',
        'title',
        'description',
        'icon',
    ];

    // Get the Item Menu that owns the Page Item.
    public function menu_item()
    {
        return $this->belongsTo('App\Models\MenuItem');
    }

}

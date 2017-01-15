<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class PageSubSubItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'page_sub_sub_items';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'body',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
    ];

    // Get the Sub Item Menu that owns the Sub Page Item.
    public function menu_sub_sub_item()
    {
        return $this->belongsTo('App\Models\MenuSubSubItem');
    }

}

<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class PageItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'page_items';
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

    // Get the Item Menu that owns the Page Item.
    public function menu_item()
    {
        return $this->belongsTo('App\Models\MenuItem');
    }

}

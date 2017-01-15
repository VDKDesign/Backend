<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class MenuCategorie extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'menu_categorie';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'name',
        'primary',
    ];

    // Get the Menu Items for the Menu Categorie.
    public function menu_items()
    {
        return $this->hasMany('App\Models\MenuItem')->orderBy('rank');
    }
}

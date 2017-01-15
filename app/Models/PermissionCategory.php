<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class PermissionCategory extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'permissions_category';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'name',
        'description',
    ];

    public function permissions()
    {
        return $this->hasMany('App\Models\Permission');
    }

}

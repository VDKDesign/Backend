<?php namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $primaryKey = 'id';
    protected $table = 'permissions';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'name',
        'display_name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'permission_role', 'permission_id', 'role_id');
    }

    public function permissions_category()
    {
        return $this->belongsTo('App\Models\PermissionCategory');
    }

}
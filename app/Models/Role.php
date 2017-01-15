<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'name',
        'display_name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user','role_id', 'user_id');
    }
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role', 'role_id', 'permission_id');
    }

}
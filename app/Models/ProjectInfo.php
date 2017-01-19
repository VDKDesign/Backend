<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ProjectData extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'project_data';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable =[
        'name',
        'subname',
        'create_year',
        'filename',
    ];
}

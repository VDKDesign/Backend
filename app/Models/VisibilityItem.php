<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class VisibilityItem extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'visibility_items';
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable =[
        'name',
        'visibility',
    ];

}

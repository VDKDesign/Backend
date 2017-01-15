<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ToDoList extends Eloquent
{
    protected $primaryKey = 'id';
    protected $table = 'to_do_list';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable =[
        'item',
    ];
}

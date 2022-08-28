<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['rol_id', 'action_id', 'section_id'];
    public $timestamps = false;


    public function roles(){
        return $this->belongsTo(User::class);
    }

    public function action(){
        return $this->hasOne(Action::class, 'id', 'action_id');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public static function has(int $rolId, String $action,int $sectionId){

        $result = Permission::join('actions', 'actions.id', '=', 'permissions.action_id')
                    ->where('actions.action', '=', $action)
                    ->where('permissions.section_id', '=', $sectionId)
                    ->where('permissions.rol_id', '=', $rolId)->get();
                    
        return ($result->count() === 1);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    
    public static $ADMIN = 1;
    public static $USER  = 2;

    protected $table = 'roles';
    protected $fillable = ['rol'];
    public $timestamps = false;


    public function users(){
        return $this->hasMany(User::class);
    }


    public function permissions(){
        return $this->hasMany(Permission::class);
    }

}



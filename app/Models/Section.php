<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = ['model', 'id'];
    public $timestamps = false;

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

    public static function getId($model){
        return Section::where('model', $model)->first()->id; 
    }
}

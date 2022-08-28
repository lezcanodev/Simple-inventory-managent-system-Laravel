<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Section;

class Provider extends Model
{
    use HasFactory;
    protected $fillable =['name','phone','gmail','location', 'user_id'];



    public static function sectionId(){
        return Section::getId('App\Models\Provider');
    }

    public function user(){
        return $this->hasOne(User::class);
    }


    public function products(){
        return $this->hasMany(Product::class);
    }

    public function categories(){
        return $this->morphToMany(Category::class, 'categorizables');
    }


}

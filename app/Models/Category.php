<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Provider, Product};

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public $timestamps = false;

    public function providers(){
        return $this->morphedByMany(Provider::class, 'categorizables');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}

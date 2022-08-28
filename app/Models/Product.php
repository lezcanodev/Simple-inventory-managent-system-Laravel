<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Provider;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_at', 'updated_at', 'stock', 'sale_price', 'purchase_price', 'description', 'user_id', 'provider_id', 'category_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}

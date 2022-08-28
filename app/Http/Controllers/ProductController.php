<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    public function index(Request $req){
        
        $this->authorize('view', Product::class);

        $products = Product::when($req->search, function($query, $search){
                        $query->where('name', 'like', '%'.$search.'%')
                            ->orWhere('description', 'like', '%'.$search.'%');
                    })
                    ->when($req->provider, function($query, $provider){
                        $query->where('provider_id', $provider);
                    })
                    ->when($req->category, function($query, $category){
                        $query->where('category_id', $category);
                    })
                    ->when($req->user, function($query, $user){
                        $query->where('user_id', $user);
                    })
                    ->when($req->order, function($query, $order){
                        
                        if($order == 'orderby_stock'){
                            $query->orderBy('stock', 'desc');
                        }else if($order == 'orderby_price'){
                            $query->orderBy('sale_price', 'desc');
                        }else{
                            $query->orderBy('created_at', 'DESC');
                        }
                        
                    }, function($query){
                        $query->orderBy('created_at', 'DESC');
                    })->paginate(15);

        return view('dashboard.products.index',[
            'products' => $products,
            'categories' => Category::get(),
            'providers' => Provider::select('id', 'name')->get(),
            'users' => User::select('id', 'name')->get()
        ]);
    }

    public function view(Product $product){
        $this->authorize('view', Product::class);
        
        return view('dashboard.products.view',[
            'product' => $product,
        ]);
    }

    public function destroy(Request $req){
        
        $req->validate([
            'productId' => 'required|exists:products,id'
        ]);
        

        $this->authorize('destroy', Product::find((int)$req->productId));

        $result = false;

        if(Storage::disk('products')->exists($req->productId)){
            if(Storage::disk('products')->deleteDirectory($req->productId)){
                $result = Product::where('id', (int)$req->productId)->delete();
            }
        }else{
            $result = Product::where('id', (int)$req->productId)->delete();
        }
 
        $msg = $result ? 'Product deleted' : 'Product could not be removed';
      
        return redirect()->back()->with('msg' , $msg );
    }

    public function create(Provider $provider){

        $this->authorize('create', Product::class);

        return view('dashboard.products.create',[
            'selectedProvider' => $provider->categories->count() !== 0,
            'providers' =>   $provider->categories->count() !== 0 ? $provider : Provider::get()
        ]);
    }

    public function store(Request $req){

        $req->validate([
            'provider' => ['required', 'exists:providers,id'],
            'name' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'sale_price' => ['required'],
            'pruchase_price' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'description' => ['required']
        ]);

        $productId = Product::insertGetId([
            'name' => $req->name,
            'stock' => $req->stock,
            'sale_price' => $req->sale_price,
            'purchase_price' => $req->pruchase_price,
            'description' => $req->description,
            'provider_id' => $req->provider,
            'category_id' => $req->category,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' =>  Carbon::now()
        ]);


        if($req->hasFile('imgs')){
            $allowedExtensions = ['jpg', 'png', 'jpeg'];

            if(Storage::disk('products')->makeDirectory($productId)){
                foreach($req->imgs as $img){
                    $extension = $img->getClientOriginalExtension();
          
                    if(!$img->getError() && in_array($extension, $allowedExtensions)){
                        $img->store('products/'.$productId);
                    }
                }
            }
          
        }

        return back()->with('msg', 'Product uploaded');
    }


    public function update(Product $product){

        $this->authorize('update', $product);

        return view('dashboard.products.update',[
            'product' => $product,
            'providers' =>  Provider::find($product->provider->id)
        ]);
    }


    public function updated(Request $req){
        $req->validate([
            'product' => ['required', 'integer'],
            'provider' => ['required', 'exists:providers,id'],
            'name' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'sale_price' => ['required'],
            'pruchase_price' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'description' => ['required']
        ]);

        
        if($req->hasFile('imgs') && count($req->imgs) > 0){
            $allowedExtensions = ['jpg', 'png', 'jpeg'];
            $productId = $req->product;

            if(!Storage::disk('products')->exists($productId)){
                Storage::disk('products')->makeDirectory($productId);
            }

            foreach($req->imgs as $img){
                $extension = $img->getClientOriginalExtension();
        
                if(!$img->getError() && in_array($extension, $allowedExtensions)){
                    $img->store('products/'.$productId);
                }
            }
        }

       $result =  Product::where('id','=', $req->product)
               ->where('user_id','=',  $req->user ?? Auth::user()->id)
               ->update([
                    'name' => $req->name,
                    'stock' => $req->stock,
                    'sale_price' => $req->sale_price,
                    'purchase_price' => $req->pruchase_price,
                    'description' => $req->description,
                    'provider_id' => $req->provider,
                    'category_id' => $req->category,
                    'user_id' => $req->user ?? Auth::user()->id,
                    'updated_at' =>  Carbon::now()
                ]);

        return back()->with('msg', 'Product Updated');
    }
}

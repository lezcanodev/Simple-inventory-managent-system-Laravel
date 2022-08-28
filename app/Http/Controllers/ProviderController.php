<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Provider;
use Illuminate\Support\Facades\DB;
use App\Models\Section;
use Carbon\Carbon;

class ProviderController extends Controller
{
    public function index(){
        $this->authorize('view',  Provider::class);
        
        return view('dashboard.providers.index', [
            'providers' => Provider::orderBy('created_at', 'desc')->paginate(20)
        ]);
    }

    public function create(){
        
        $this->authorize('create',  Provider::class);

        return view('dashboard.providers.create', [
            'categories' => Category::get()
        ]);
    }

    public function store(Request $req){
        $this->authorize('create',  Provider::class);

       $req->validate([
        'user' => [ 'required'],
        'name' => [ 'required', 'unique:providers,name'],
        'phone' => [ 'required'],
        'email' => [ 'required'],
        'location' => [ 'required']
       ]);

       $providerId = Provider::insertGetId([
        'user_id' => $req->user,
        'name' => $req->name,
        'phone' => $req->phone,
        'gmail' => $req->email,
        'location' => $req->location,
        'created_at' => Carbon::now()
       ]);

       if(!$providerId) return back()->with('msg', 'Ocurred Error');

       $providerHasCategories = [];
       foreach($req->categories as $category){
          array_push($providerHasCategories, [
            'category_id' => $category,
            'categorizables_id' => $providerId,
            'categorizables_type' => 'App\Models\Provider'
          ]);
       }

       DB::table('categorizables')->insert($providerHasCategories);

       return back()->with('msg', 'Provider added');
    }


    public function destroy(Request $req){
        $this->authorize('delete',  Provider::class);

        $req->validate([
            'providerId' => 'required|exists:providers,id'
        ]);
        
        $this->authorize('destroy', Provider::find((int)$req->providerId));

        DB::table('categorizables')->where('categorizables_id', $req->providerId)->delete();

        $result = Provider::where('id', $req->providerId)->delete();
     
        if(!$result) return back()->with('msg', 'Ocurred Error');

        return back()->with('msg', 'Provider deleted');
    }
}

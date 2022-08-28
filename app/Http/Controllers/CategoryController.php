<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $this->authorize('view', Category::class);

        return view('dashboard.categories.index', [
            'categories' => Category::orderBy('id','desc')->get()
        ]);
    }

    public function create(){
        $this->authorize('create', Category::class);

        return view('dashboard.categories.create');
    }

    public function store(Request $req){

        $req->validate([
            'name' => ['required', 'unique:categories,name']
        ]);

        $result = Category::create([
            'name' => $req->name
        ]);

        if(!$result) return back()->with('msg', 'Occurred error');

        return back()->with('msg', 'Success');
    }

    public function destroy(Request $req){
        $this->authorize('delete', Category::class);

        $req->validate([
            'category' => ['required', 'exists:categories,id']
        ]);

        $result = Category::where('id', $req->category)->delete();

        if(!$result) return back()->with('msg', 'Occurred error');

        return back()->with('msg', 'Deleted');
    }


    public function update(Request $req){
        $category = Category::where('id',$req->category)->firstOrFail();

        $this->authorize('update', $category);

        return view('dashboard.categories.update', [
            'category' => $category
        ]);
    }

    public function updated(Request $req){
        $req->validate([
            'name' => ['required', 'unique:categories,name'],
            'category' => ['required', 'exists:categories,id']
        ]);

        $result = Category::where('id', $req->category)->update([
            'name' => $req->name
        ]);

        if(!$result) return back()->with('msg', 'Occurred error');

        return back()->with('msg', 'Updated');
    }


}

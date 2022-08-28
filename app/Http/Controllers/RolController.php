<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Permission;
use App\Models\Rol;
use App\Models\Section;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RolController extends Controller
{
    public function index(){
        $this->authorize('view', Rol::class);

        return view('dashboard.roles.index', [
            'roles' => Rol::get()
        ]);
    }

    public function create(){
        $this->authorize('create', Rol::class);

        return view('dashboard.roles.create', [
            'actions' => Action::get(),
            'sections' => Section::get()
        ]);
    }

    public function destroy(Request $req){
        $this->authorize('destroy', Rol::class);

        $req->validate([
            'rol' => ['required', 'exists:roles,id']
        ]);

        $result = Rol::where('id', $req->rol)->delete();

        if(!$result) return back()->with('msg', 'Occurred Error');

        return back()->with('msg', 'Success');
    }

    public function store(Request $req){

        Validator::extend('exists_section', function($attribute, $value, $parameters){
            if(count($value) == 0) return false;

            return !Validator::make(['sections' => array_keys($value)], [
                'sections' => ['exists:sections,id']
            ])->fails();

        }, 'Section not found');
        
       $validator = Validator::make($req->all(), [
        'name' => 'required|string|unique:roles,rol',
        "section"    => ['required','array', 'exists_section'],
        "section.*"  => "required|array|exists:actions,id",
       ]);


       if(count($validator->errors()) > 0)  return back()->withErrors($validator->errors()->toArray());

       $rol = Rol::insertGetId([
            'rol' => $req->name 
       ]);

       $permissions = [];

       foreach($req->section as $section => $actions){
           foreach($actions as $action){
               array_push($permissions, [
                   'rol_id' => $rol, 
                   'action_id' => $action, 
                   'section_id' => $section
               ]);
           }
       }

       $result = Permission::insert($permissions);

       if(!$result) return back()->with('msg', 'Occurred Error');

       return back()->with('msg', 'Success');
    }
}

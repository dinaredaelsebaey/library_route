<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
//////////////////////////////////////All//////////////////////////////////////
public function index(){
    //select all
    $categories=Category::get();
    return view('categories.index',compact('categories'));
    
    //select spesific data
    //$categories=Category::select('title')->get();
    
    //select condition 
    //$categories=Category::where('id','<=',5)->get();
    //dd($categories);
    
   }
//////////////////////////////////////show//////////////////////////////////////
   public function show($id){
      $theCategory=Category::findOrFail($id);
      return view('categories.show',compact('theCategory'));
  
   }
//////////////////////////////////////create//////////////////////////////////////
   public function create(){
      return view('categories.create');
   }
//////////////////////////////////////store//////////////////////////////////////
   public function store(Request $request){
         $request->validate([
            'name'=>'required|max:100|string',
            
         ]);

         
         
         $name=$request->name;
        
         
         Category::create([
            'name'=>$name,
         ]);
         return redirect(route('categories.create'));
   }
//////////////////////////////////////edit//////////////////////////////////////
   public function edit($id){
      $editCategory=Category::findOrFail($id);
      return view('categories.edit',compact('editCategory'));
   }
//////////////////////////////////////update//////////////////////////////////////
   public function update(Request $request, $id){
      $request->validate([
         'name'=>'required|max:100|string',
      ]);
      $name=$request->name;
      Category::findOrFail($id)->update([
         'name'=>$name,
        ]);
      return redirect(route('categories.index',$id));
      }
   //////////////////////////////////////delete//////////////////////////////////////
    public function delete($id){
    Category::findOrFail($id)->delete();
      return redirect(route('categories.index'));
   }
   
}
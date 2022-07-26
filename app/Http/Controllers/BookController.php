<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
//////////////////////////////////////All//////////////////////////////////////
   public function index(){
    //select all
    $books=Book::get();
    return view('books.index',compact('books'));
    
    //select spesific data
    //$books=Book::select('title')->get();
    
    //select condition 
    //$books=Book::where('id','<=',5)->get();
    //dd($books);
    
   }
//////////////////////////////////////show//////////////////////////////////////
   public function show($id){
      $theBook=Book::findOrFail($id);
      return view('books.show',compact('theBook'));
  
   }
//////////////////////////////////////create//////////////////////////////////////
   public function create(){
      return view('books.create');
   }
//////////////////////////////////////store//////////////////////////////////////
   public function store(Request $request){
         $request->validate([
            'title'=>'required|max:100|string',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:JPG,jpg,png'

         ]);

         //receive img object 
         $image=$request->file('img');
         //put extension
         $ext=$image->getClientOriginalExtension();
         //put name to img
         $name=uniqid() . ".$ext";
         //move img
         $image->move(public_path('uploads/imgs'),$name);
           
         
         $title=$request->title;
         $desciption=$request->desc;
         
         Book::create([
            'title'=>$title,
            'desc'=>$desciption,
            'img'=>$name
         ]);
         return redirect(route('books.create'));
   }
//////////////////////////////////////edit//////////////////////////////////////
   public function edit($id){
      $editBook=Book::findOrFail($id);
      return view('books.edit',compact('editBook'));
   }
//////////////////////////////////////update//////////////////////////////////////
   public function update(Request $request, $id){
      $request->validate([
         'title'=>'required|max:100|string',
         'desc'=>'required|string',
         'img'=>'nullable|image|mimes:JPG,jpg,png'
      ]);

      if ($request->hasFile('img')){

         //receive img object 
         $image=$request->file('img');
         //put extension
         $ext=$image->getClientOriginalExtension();
         //put name to img
         $name=uniqid() . ".$ext";
         //move img
         $image->move(public_path('uploads/imgs'),$name);
      }
      
      $title=$request->title;
      $description=$request->desc;
    
      
      
      Book::findOrFail($id)->update([
         'title'=>$title,
         'desc'=>$description,

      ]);
      return redirect(route('books.index',$id));
      }
   //////////////////////////////////////delete//////////////////////////////////////
    public function delete($id){
      Book::findOrFail($id)->delete();
      return redirect(route('books.index'));
   }
   
}
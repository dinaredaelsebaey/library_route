<?php

namespace App\Http\Controllers;
use App\Models\Book;

use Illuminate\Http\Request;

class ApiBookController extends Controller
{
    public function index(){
        //select all
        $books=Book::get();
        return response()->json($books);
    }
    public function show($id){
        $theBook=Book::findOrFail($id);
        return response()->json($theBook);
    
     }

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
        
        $success="book stored successfully";
        return response()->json($success);
    }
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
      $sucess="the book updated successfully";
      return response()->json($sucess);
    }

    public function delete($id){
        $book=Book::findOrFail($id);
        $book->categories()->sync([]);
        $book->delete();
        $sucess="the book deleted successfully";
        return response()->json($sucess);
     }
  

        
}
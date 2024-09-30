<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{
    //display all products
public function index(){
    $products=Product::paginate(3);
    return view("admin.displayProducts",['products'=>$products]);
}

public function createProductForm(){
    
    
    
    return view("admin.createProductForm");
}
//send Pro to Db
public function sendCreateProductForm(Request $request){
    $name=$request->input('name');
    $description=$request->input('description');
    $price=$request->input('price');
    $type=$request->input('type');
    Validator::make($request->all(),['image'=>"required|image|mimes:jpg,png,jpeg,gif|max:5000"])->validate();
    $ext=$request->file('image')->getClientOriginalExtension();
    $stringImageReFormat =str_replace("","",$request->input('name'));
    $imageName =$stringImageReFormat.".".$ext;
   $imageEncoded= File::get($request->image);
    Storage::disk('local')->put('public/pimages/'.$imageName,$imageEncoded);
    $newProductArray=array("name"=>$name,"description"=>$description,"image"=>$imageName,"type"=>$type,"price"=>$price);
    $created=DB::table("products")->insert($newProductArray);
    if($created){
        return redirect()->route("adminDisplayProducts");  
    }else{
        return "product was not created";
    }


}







//edit product form
public function editProductForm($id){
    $product=Product::find($id);
    return view('admin.editProductForm',['product'=>$product]);

}
//edit product image
public function editProductImageForm($id){
    $product=Product::find($id);
    return view('admin.editProductImageForm',['product'=>$product]);
}
//updateProductImage
public function updateProductImage(Request $request,$id ){
    Validator::make($request->all(),['image'=>"required|image|mimes:jpg,png,jpeg|max:5000"])->validate();

    if ($request->hasFile("image")){
        
        $product=Product::find($id);

        $exists=Storage::disk('local')->exists("public/pimages/".$product->image);
             //delete old pic
             if($exists){
                 Storage::delete('public/pimages/'.$product->image);

             }
             //upload new pic
             $ext=$request->file('image')->getClientOriginalExtension();

             $request->image->storeAs("public/pimages/",$product->image);             
             
             $arrayToUpdate=array('image'=>$product->image);

             DB::table('products')->where('id',$id)->update($arrayToUpdate);
             return redirect()->route("adminDisplayProducts");  
    }else{
        $error="NO Image Was Selected";
        return $error;
    }

}
 public function updateProduct(Request $request,$id){
     $name=$request->input('name');
     $description=$request->input('description');
     $price=$request->input('price');
     $type=$request->input('type');


$arrayToUpdate=array("name"=>$name,"description"=>$description,"type"=>$type,"price"=>$price);
     DB::table('products')->where('id',$id)->update($arrayToUpdate);
     return redirect()->route("adminDisplayProducts");  
       }   


    

      public function deleteProduct($id){
          $product=Product::find($id);
          $exists=Storage::disk('local')->exists("public/pimages/".$product->image);
          //delete old pic
          if($exists){
              Storage::delete('public/pimages/'.$product->image);

          }
          Product::destroy($id);
          return redirect()->route("adminDisplayProducts");


        }}
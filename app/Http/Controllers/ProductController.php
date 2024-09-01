<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('products.index',[
            'products'=>Product::latest()->paginate(5)
        ]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        // Validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:10000'
        ]);

        // Upload Image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        // Save Product
        $product = new Product;
        $product->image = $imageName;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Product Created !!!!!!');
    }

    public function edit($id){
        $product = Product::where('id',$id)->first();
        return view('products.edit',[ 'product' => $product]);
    }

    public function update(Request $request, $id) {
        // Validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:10000'
        ]);
  
        $product = Product::where('id', $id)->first();

         if(isset($request->image)){

               // Upload Image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('products'), $imageName);
        $product->image = $imageName;


         }
     

        // Save Product
        // $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Product Updated !!!!!!');
    }



    
    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return back()->withSuccess('Product delete !!!!!');
}


public function show($id){
    $product = Product::where('id',$id)->first();
    return view('products.show',['product'=>$product]);
}

}
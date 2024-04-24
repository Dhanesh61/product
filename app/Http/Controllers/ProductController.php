<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $product = Product::get();
        return view('/index', ['product' => $product]);
    }
    
    
        public function create(){
            return view('/create');
        }
    
        public function store(Request $request){
            //validate data
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,gif|max:1000'
                ], [
                        'name.required' => '**The name field is required.',
                        'description.required' => '**The description field is required.',
                        'image.required' => '**The image field is required.',
                ]);
                
                //upload image
                $imageName = time().'.'.$request->image->extension();
               
            $request->image->move(public_path('product'),$imageName);
    
            $product = new Product;
            $product->image = $imageName;
            $product->name = $request->name;
            $product->description = $request->description;
           
    
            $product->save();
             return back()->withSuccess('Product Created');
        }
        public function edit($id){
            //dd($id);
            $product = Product::where('id',$id)->first();
            return view('edit',['product'=>$product]);
        }
     
        public function update(Request $request, $id){
          // dd($request->all());
           $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1000'
            ], [
                    'name.required' => '**The name field is required.',
                    'description.required' => '**The description field is required.',
                    // 'image.required' => '**The image field is required.',
            ]);
            
            $product = Product::where('id',$id)->first();
    
            if(isset($request->image)){
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('product'),$imageName);
                $product->image = $imageName;
            }
            //upload image
          
       
        $product->name = $request->name;
        $product->description = $request->description;
       
    
        $product->save();
        return redirect()->route('product.index')->withSuccess('Product Updated');
    
        }
    
        public function delete($id){
            $product = Product::findOrFail($id);

            // Delete the image file if it exists
            $imagePath = public_path('product') . '/' . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $product->delete();
            return back()->withSuccess('Product Deleted');
        }
}

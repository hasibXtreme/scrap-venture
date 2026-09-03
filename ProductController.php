<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class ProductController extends Controller
{

   public function productindex()
   {
     $products = Product::latest()->get();

     return View('admin.products.index',compact('products'));
   }

   public function productcreate()
   {
     return View('admin.products.create');
   }
    public function productinput(Request $request)
    {
        $validated = $request->validate([
            'product_name'=>'required|string|max:255',
            'image'=>'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'description'=>'required|string|max:1000',
            'price'=>'required|numeric',
            'category'=>'required|string|max:100'
        ]);

        $imagepath = null;
        if($request->hasFile('image'))
            {
                $imagepath=Cloudinary::upload($request->file('image')->getRealPath(),[
                    'folder'=>'products',
                ])->getRealPath();
            }

        Product::create([
            'product_name'=>$validated['product_name'],
            'image'=>$imagepath,
            'description'=>$validated['description'],
            'price'=>$validated['price'],
            'category'=>$validated['category']
        ]);    
       
        return redirect()->route('admin.products.index')->with('success','New products added');
    }

    public function productdlt(Product $product)
    {
        if($product->image)
            {
                Cloudinary::destroy($product->image);
            }
        $product->delete();
        return redirect()->back()->with('success','product deleted');
    }

    public function updatewindow(Product $product)
    {
        return View('admin.products.edit',compact('product'));
    }

    public function productupdate(Request $request,Product $product)
    {
        $validated = $request->validate([
            'product_name'=>'nullable|string|max:255',
            'image'=>'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'description'=>'nullable|string|max:1000',
            'price'=>'nullable|numeric',
            'category'=>'nullable|string|max:100'
        ]);

        
        if($request->hasFile('image'))
            {
               
                if($product->image)
                    {
                        Cloudinary::destroy($product->image);
                    }
                $validated['image']= Cloudinary::upload($request->file('image')->getRealPath(),[
                    'folder'=>'products',
                ])->getRealPath(); 
            }

            else 
                {
                    unset($validated['image']);
                }

            $product->update($validated);

            return redirect()->route('admin.products.index')->with('success','product deleted');
    }



    
}

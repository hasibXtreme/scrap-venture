<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collector;
use App\Models\Product;
use Illuminate\View\View;

class CollectorController extends Controller
{
    public function index()
    {
        $collectors = Collector::where('is_verified',true)->latest()->get();
        $products = Product::latest()->get();
        return View('collectors.index',compact('collectors','products'));
    }
     public function create()
     {
        return View('collectors.create');
     }
     
     public function store(Request $request)
     {
        $validated = $request->validate([
          'name'=> 'required|string|max:255',
          'phone'=>'required|string|max:16',
          'location'=>'required|string|max:11',
          'picture'=>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagepath=null;

        if($request->hasFile('picture'))
            {
             $imagepath = $request->file('picture')->store('collectors','public');
            }

            Collector::create(
                [
                'name'=>$validated['name'],
                'phone'=>$validated['phone'],
                'location'=>$validated['location'],
                'picture'=>$imagepath,
                'is_verified'=>false,
                ]
            );
            return redirect()->route('collectors.index')->with('success','collector register successfully');
     }

     public function adminindex()
     {
        $pendingcollectors = Collector::where('is_verified',false)->latest()->get();
        $verifiedcollectors = Collector::where('is_verified',true)->latest()->get();

        return View('admin.collectors.index' ,compact('pendingcollectors','verifiedcollectors'));
     }

     public function verify(Collector $collector)
     {
        $collector->update(['is_verified'=>true]);
        return redirect()->back()->with('success','collector is verified');
     }

     public function destroy(Collector $collector)
     {
        $collector->delete();
        return redirect()->back()->with('success','collector is not accepted');
     }
     
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = null;
        if($request->has('q') && $request->filled('q')){
            $products = Product::where('name', 'like', "%$request->q%" )->get();
        }else{
            $products = Product::all();
        }
        ///// show
        if($request->has('show') && $request->filled('show')){
           $product = Product::find($request->show);
           $showDialogShow = true;
        }else{
            $showDialogShow = false;
        }
    ///// edit
        if($request->has('edit') && $request->filled('edit')){
            $product = Product::find($request->edit);
            $showDialogForm = true;
         }else{
             $showDialogForm = false;
         }

          $categories = Category::all(['id','name']);
          return Inertia::render('Product/Index',[
            'products' => $products,
            'categories' => $categories,
            'q' => $request->q,
            'product' => $product,
            'showDialogShow' => $showDialogShow,
            'showDialogForm' => $showDialogForm,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Product::create($request->validate([
        'name' => 'required',
        'price' => 'required',
        'stock' => 'required',
        'user_id' => 'required',
        'category_id' => 'required',
      ]));
       
       /*
        $newProduct = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
           ]);
           Product::create($newProduct);
           return redirect()->route('product.index');
*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return  Inertia::render('Product/Show',[
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit',[
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
         $product->update($request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        ]));


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}

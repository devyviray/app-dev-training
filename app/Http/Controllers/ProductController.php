<?php

namespace App\Http\Controllers;

use App\Product; // important 

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $data = $request->all();

        // return $products = Product::all();

        // return $products = Product::select('id','name','detail')->get();


        // return $products = Product::select('id','name','detail')
        //                             ->where('name','=','Laptop') // Where conditons 
        //                             ->get();


        // return $products = Product::select('id','name','detail')
        //                             ->where('name','=',$data['name']) // Where conditons 
        //                             ->get();

        // return $products = Product::select('id','name','detail','type_id')
        //                             ->with('type')
        //                             ->get();










        $products = Product::latest()->paginate(3); //
    
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', // This name is required
            'detail' => 'required',
        ]);
  
        Product::create($request->all()); // Line na maggsave sa databale 
   
        return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product) // url => http://127.0.0.1:8000/products/4
    {
        return view('products.show',compact('product')); // tawagin ung blade sa view / tapos ipadala ung variable
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) // 
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required', 
            'detail' => 'required',
        ]);
  
        $product->update($request->all()); // itong function is to update changes in datatable
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) // id
    {
        $product->delete(); // ito yung nag dedelete sa data table
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}

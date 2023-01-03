<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->paginate(5);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $product = new Product();
        return view('products.create', compact('categories', 'product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|min:4|max:25',
                'price'=>'required|numeric|between:20,1000',
                'quantity'=>'required|numeric|between:1,200',
                'category_id' => 'required',
            ]
        );

        //uploads image
        $img_name = time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/products'), $img_name);

        //insert into DB
        Product::create([
            'name' => $request->name,
            'image' => $img_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        //Redirect
        return redirect()->route('products.index')->with('msg', 'Category created successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('categories', 'product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'=>'required|min:4|max:25',
                'price'=>'require|numeric|between:20,500',
                'quantity'=>'required|numeric|between:1,1000'
            ]
        );

        $product = Product::findOrFail($id);
        // Uploads the files
        $img_name = $product->image;
        if($request->hasFile('image')) {
            $img_name = time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $img_name);
        }

        $product->update([
            'name' => $request->name,
            'image' => $img_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // Redirect
        return redirect()->route('products.index')->with('msg', 'Product updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = Product::findOrFail($id);

        File::delete(public_path('uploads/products/'.$product->image));

        $product->delete();

        return redirect()->route('products.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');
    }

}



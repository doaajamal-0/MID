<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->orderByDesc('id')->paginate(5);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Data
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Upload File
        $img_name = time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/categories'), $img_name);


        // Insert To Database
        Category::create([
            'name' => $request->name,
            'image' => $img_name,
            'parent_id' => $request->parent_id
        ]);

        // Redirect
        return redirect()->route('categories.index')->with('msg', 'Category created successfully')->with('type', 'success');
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('categories', 'category'));
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
        // Validate Data
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::findOrFail($id);

        // Upload File
        $img_name = $category->image;
        if($request->hasFile('image')) {
            $img_name = time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/categories'), $img_name);
        }


        // Insert To Database
        $category->update([
            'name' => $request->name,
            'image' => $img_name,
            'parent_id' => $request->parent_id
        ]);

        // Redirect
        return redirect()->route('categories.index')->with('msg', 'Category updated successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        File::delete(public_path('uploads/categories/'.$category->image));

        $category->children()->update(['parent_id' => null]);

        $category->delete();

        return redirect()->route('categories.index')->with('msg', 'Category deleted successfully')->with('type', 'danger');

    }
}


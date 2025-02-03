<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $action = '<a href="'.route("category.edit", $row->id).'">Edit</a>
                    <form action="'.route("category.destroy", $row->id).'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';                    
                    return $action;
                })
                ->addColumn('banner_image', function ($row) {
                    return '<img src="'.$row->getFirstMediaUrl('banner_image').'"width="100"/>';
                })
                ->addColumn('thumbnail', function ($row) {
                    return '<img src="'.$row->getFirstMediaUrl('thumbnail').'"width="100"/>';
                })
                
                ->rawColumns(['update','action', 'description', 'banner_image','thumbnail'])
                ->make(true);
        }
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
       return view('category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'show_in_menu' => 'required',
            'status' => 'required',
            'short_description' => 'required',
            'description' => 'required'
        ]); 

        $data = $request->all();
        $category = Category::create($data);
        if($request->hasFile('banner_image') && $request->file('banner_image')->isValid()){
            $category->addMediaFromRequest('banner_image')->toMediaCollection('banner_image');
        }
        if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()){
            $category->addMediaFromRequest('thumbnail')->toMediaCollection('thumbnail');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Category::all();
        $category = Category::find($id);
        return view('category.edit', compact('category','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);
        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }
}

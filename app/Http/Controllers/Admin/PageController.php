<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = Page::all();
        if ($request->ajax()) {
            $data = Page::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $action = '<a href="'.route("page.edit", $row->id).'">Edit</a>
                    <form action="'.route("page.destroy", $row->id).'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';                    
                    return $action;
                })
                ->addColumn('banner', function ($row) {
                    return '<img src="'.$row->getFirstMediaUrl('banner').'"width="100"/>';
                })
                
                ->rawColumns(['update','action', 'description', 'banner'])
                ->make(true);
        }
        return view('page.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'heading' => 'required',
            'status' => 'required',
            'description' => 'required'
            
        ]);


         $data = $request->all();
         $page = Page::create($data);
        if($request->hasFile('banner') && $request->file('banner')->isValid()){
            $page->addMediaFromRequest('banner')->toMediaCollection('banner');
        }

         return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {   $page = $request->only('title','status','heading','url_key','description');
        Page::where('id', $id)->update($page);
        $page = Page::where('id', $id)->find($id);

        if($request->hasFile('banner')){
            $page->clearMediaCollection('banner');
            $page->addMediaFromRequest('banner')->toMediaCollection('banner');
        }
        return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
    //    $page = Page::fild($id);
     $page->delete();
      return view('page.index');
    }
}

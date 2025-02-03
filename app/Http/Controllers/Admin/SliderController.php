<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Slider::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $action = '<a href="'.route("slider.edit", $row->id).'">Edit</a>
                    <form action="'.route("slider.destroy", $row->id).'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';                    
                    return $action;
                })
                ->addColumn('slider_image', function ($row) {
                    return '<img src="'.$row->getFirstMediaUrl('slider_image').'"width="100"/>';
                })
                
                ->rawColumns(['update','action', 'description', 'slider_image'])
                ->make(true);
        }
        return view('slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'link' => 'required',
            'description' => 'required'
        ]); 

        $data = $request->all();
        $slider = Slider::create($data);
        if($request->hasFile('slider_image') && $request->file('slider_image')->isValid()){
            $slider->addMediaFromRequest('slider_image')->toMediaCollection('slider_image');
        }
        return redirect()->route('slider.index');
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
        $slider = Slider::find($id);
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = $request->only('title','status','link','description','slider_image');
        Slider::where('id', $id)->update($slider);
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Slider::find($id)->delete();
        return redirect()->back();
    }
}

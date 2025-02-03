<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Spatie\MediaLibrary\HasMedia;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blocks = Block::all();
        if ($request->ajax()) {
            $data = Block::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $action = '<a href="'.route("block.edit", $row->id).'">Edit</a>
                    <form action="'.route("block.destroy", $row->id).'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';                    
                    return $action;
                })
                ->addColumn('image', function ($row) {
                    return '<img src="'.$row->getFirstMediaUrl('image').'"/>';
                })
                
                ->rawColumns(['update','action', 'description', 'image'])
                ->make(true);
        }
        // dd();
        return view('block.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('block.create');
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
         $blocks = Block::create($data);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $blocks->addMediaFromRequest('image')->toMediaCollection('image');
        }

         return redirect()->route('block.index');

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
    public function edit(Block $block)
    {
        return view('block.edit', compact('block'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Block $block)
    {
        $user = $request->all();
        //  $user = $request->only('title','status','heading','url_key','description');  
        //  Block::where('id', $id)->update($user);
        $block->update($user);
         return redirect()->route('block.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Block $block)
    {
        $block->delete();
        return view('block.index');
    }
}

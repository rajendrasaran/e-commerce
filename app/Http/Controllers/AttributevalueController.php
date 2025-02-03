<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attributevalue;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttributevalueController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Attributevalue::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="'.route("attribute-value.edit", $row->id).'" class="edit btn btn-success btn-sm">Edit</a>
                    <form action="'.route("attribute-value.destroy",$row->id).'" method="post" class="delete btn btn-success btn-sm">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>
                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Attribute-value.index');
    }

    public function create(){
        $attribute = Attribute::all();
        return view('Attribute-value.create', compact('attribute'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "attribute_id" => "required",
            "name" => "required",
            "status" => "required"
        ]);

       
        Attributevalue::create([
            "attribute_id" => $request->input('attribute_id'),
            "name" => $request->input('name'),
            "status" => $request->input('status'),
        ]);

        return redirect()->route('attribute-value.index');
    }

    public function edit($id)
    {
        $attribute = Attribute::all();
        $data = Attributevalue::find($id);
        return view('Attribute-value.edit', compact('data', 'attribute'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            "name" => "required",
            "status" => "required"
        ]);

        $data = Attributevalue::find($id);
        $data->update([
            "attribute_id" => $request->input('attribute_id'),
            "name" => $request->input('name'),
            "status" => $request->input('status'),
        ]);

        return redirect()->route('attribute-value.index');
    }

    public function destroy($id)
    {
        $data = Attributevalue::find($id);
        $data->delete();
        return redirect()->back();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Attributevalue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route("attribute.edit", $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                    <form action="' . route("attribute.destroy", $row->id) . '" method="post" class="delete btn btn-success btn-sm">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>
                    ';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Attribute.index');
    }

    public function create()
    {
        return view('Attribute.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "name_key" => "required",
            "is_variant" => "required",
            "status" => "required"
        ]);
        $data = $request->all();
        $Attribute = Attribute::create([
            "name" => $request->input('name'),
            "name_key" => $request->input('name_key'),
            "is_variant" => $request->input('is_variant'),
            "status" => $request->input('status'),
        ]);

        $names = $request['attribute_name'];
        $statuses = $request['attribute_status'];

        foreach ($names as $key => $name) {
            if ($name) {
                $status = $statuses[$key];
                $AttributeValue = [
                    "attribute_id" => $Attribute->id,
                    "attribute_name" => $name,
                    "attribute_status" => $status
                ];
                Attributevalue::create($AttributeValue);
            }
        }


        return redirect()->route('attribute.index');
    }

    public function edit(Attribute $attribute)
    {
        $data = $attribute;
        return view('attribute.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "name_key" => "required",
            "is_variant" => "required",
            "status" => "required"
        ]);

        $data = Attribute::find($id);
        $data->update([
            "name" => $request->input('name'),
            "name_key" => $request->input('name_key'),
            "is_variant" => $request->input('is_variant'),
            "status" => $request->input('status'),
        ]);

        return redirect()->route('attribute.index');
    }

    public function destroy($id)
    {
        $data = Attribute::find($id);
        $data->delete();
        return redirect()->back();
    }
}

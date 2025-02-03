<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $role = Role::all();
        if ($request->ajax()) {
            $data = Role::with('permissions')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $action = '<a href="'.route("role.edit", $row->id).'">Edit</a>
                    <form action="'.route("role.destroy", $row->id).'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';                    
                    return $action;
                })
                ->addColumn('permission', function($row){
                    return $row->permissions->pluck('name')->implode(',<br> ');
                })
                
                ->rawColumns(['update','action', 'permission'])
                ->make(true);
        }
        return view('role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::all();
        return view('role.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);
        $data = $request->all();

    // $role = Role::create([
    //     "name" => $data['name'],
    //     "permission" =>$data['permission']
    // ]);
    $roledata = [
        'name' => $data['name'],
    ];
    $role = Role::create($roledata);
    if($request->input('permissions')) {
        $role->syncPermissions($request->input('permissions'));
    }    
        return redirect()->route('role.index');

    
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
    public function edit(Role $role)
    {
        $permission = Permission::all();
        return view('role.edit',compact('role','permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            "name" => "required"
        ]);

        $role = $request->only('name'); 
        Role::where('id', $id)->update($role);
        $roles = Role::find($id);
        // if($request->input('permissions')) {
            $roles->syncPermissions($request->input('permissions'));
        // }   
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return view('role.index');
    }
}

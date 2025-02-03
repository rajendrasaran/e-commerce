<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                ->addColumn('action', function($row){
                    $action = '<a href="'.route("user.edit", $row->id).'">Edit</a>
                    <form action="'.route("user.destroy", $row->id).'" method="post">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" name="delete" value="delete">
                    </form>';                    
                    return $action;
                })
                ->addColumn('roles', function($row){
                    return $row->roles->pluck('name')->implode(',<br> ');
                })
                ->addColumn('image', function ($row) {
                    return '<img src="'.$row->getFirstMediaUrl('image').'"/>';
                })
                ->rawColumns(['update','action', 'roles','image'])
                ->make(true);
        }                              
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required",
            "email"=> "required|email",
            "password"=>"required",
            "confirm_password"=> "same:password"
         ]);      

        $data =  $request->all();
        $users = User::create($data);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $users->addMediaFromRequest('image')->toMediaCollection('image');
        }

        if($request->input('roles')) {
            $users->syncRoles($request->input('roles'));
        }   
        return redirect()->route('user.index');
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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = $request->only('name','email');
        User::where('id', $id)->update($user);
        $data = User::find($id);
        $data->syncRoles($request->input('roles'));
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}

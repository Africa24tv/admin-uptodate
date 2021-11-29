<?php

namespace App\Http\Controllers\accounts;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('name')->paginate(10);

        return view('auth.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:permissions'],
        ]);

        try{
            Permission::create($request->all());

            return redirect()->route('permissions.index')->with('success', 'Permission crée avec succès');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', "Une erreur est survenue lors de l'enregistrement de la permission");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('auth.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        try{
            $permission->update($request->all());

            return redirect()->route('permissions.index')->with('success', 'Permission modifiée avec succès');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', "Une erreur est survenue lors de la modification de la permission");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try{
            $permission->delete();

            return redirect()->route('permissions.index')->with('success', 'Permission supprimée avec succès');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', "Une erreur est survenue lors de la suppression de la permission");
        }
    }
}

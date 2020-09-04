<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(7);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $permissions = DB::table('roles_permissions')->where('role_id', '=', $id)
            ->join('permissions', 'id', '=', 'permission_id')->get();

        $allPerm = Permission::all();
        $role = Role::find($id);

        return view('roles.edit', compact('permissions', 'allPerm', 'role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->back()->with('success', 'Rol is verwijderd');
    }

    /**
     * Remove bulk resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkDestroy(Request $request)
    {
        $roles = $request->ids;

        DB::table('roles_permissions')
            ->whereIn('id', explode(",", $roles))
            ->delete();

        return response()->json(['status'=>true,'success'=>"Rollen zijn verwijderd."]);
    }

    public function destroyPermission(Request $request, $id)
    {
        DB::table('roles_permissions')
            ->where('role_id', '=', $id)
            ->where('permission_id', '=', $request->input('permission'))
            ->delete();

        return redirect()->back()->with('success', 'Rechten zijn verwijderd!');
    }

    public function updateRolePermission(Request $request, $id)
    {
            DB::table('roles_permissions')
                ->insert([
                    'role_id' => $id,
                    'permission_id' => $request->input('permission_id')
                ]);

            return redirect()->back()->with('success', 'Recht is toegekend');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $roles,
        ];

        return view('admin.role.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            Role::create([
                'name' => $request->name,
                'guard_name' => 'admin',
            ]);

            DB::commit();

            return redirect()->route('roles.index')->with('alert-success', 'Thêm vai trò thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm vai trò thất bại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $data = [
            'data_edit' => $role,
        ];

        return view('admin.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();

            $role->update([
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->route('roles.index')->with('alert-success', 'Cập nhật vai trò thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật vai trò thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();

            if ($role->users->count() > 0) {
                return redirect()->back()->with('alert-error', 'Xóa vai trò thất bại! Vai trò '.$role->name.' đang có tài khoản.');
            } elseif ($role->permissions->count() > 0) {
                return redirect()->back()->with('alert-error', 'Xóa vai trò thất bại! Vai trò '.$role->name.' đang có quyền.');
            }

            $role->delete();
            DB::commit();

            return redirect()->route('roles.index')->with('alert-success', 'Xóa vai trò thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa vai trò thất bại!');
        }
    }
}

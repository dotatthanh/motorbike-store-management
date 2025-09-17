<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Supplier::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('admin.supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        DB::beginTransaction();
        try {
            Supplier::create($request->all());

            DB::commit();

            return redirect()->route('suppliers.index')->with('alert-success', 'Thêm nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm nhà cung cấp thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $data = [
            'data_edit' => $supplier,
        ];

        return view('admin.supplier.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        DB::beginTransaction();
        try {
            $supplier->update($request->all());

            DB::commit();

            return redirect()->route('suppliers.index')->with('alert-success', 'Cập nhật nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật nhà cung cấp thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        try {
            DB::beginTransaction();

            $supplier->destroy($supplier->id);

            DB::commit();

            return redirect()->route('suppliers.index')->with('alert-success', 'Xóa nhà cung cấp thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa nhà cung cấp thất bại!');
        }
    }
}

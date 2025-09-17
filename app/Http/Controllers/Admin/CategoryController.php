<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Category::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            Category::create($request->all());

            DB::commit();

            return redirect()->route('categories.index')->with('alert-success', 'Thêm danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm danh mục thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'data_edit' => $category,
        ];

        return view('admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->update($request->all());

            DB::commit();

            return redirect()->route('categories.index')->with('alert-success', 'Cập nhật danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật danh mục thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            $category->destroy($category->id);

            DB::commit();

            return redirect()->route('categories.index')->with('alert-success', 'Xóa danh mục thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa danh mục thất bại!');
        }
    }
}

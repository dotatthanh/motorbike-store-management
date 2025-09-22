<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Shop::when($request->search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('admin.shop.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $data = [
            'companies' => $companies
        ];

        return view('admin.shop.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        DB::beginTransaction();
        try {
            Shop::create($request->all());

            DB::commit();

            return redirect()->route('shops.index')->with('alert-success', 'Thêm công ty thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm công ty thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        $companies = Company::all();

        $data = [
            'companies' => $companies,
            'data_edit' => $shop,
        ];

        return view('admin.shop.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        DB::beginTransaction();
        try {
            $shop->update($request->all());

            DB::commit();

            return redirect()->route('shops.index')->with('alert-success', 'Cập nhật công ty thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật công ty thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        try {
            DB::beginTransaction();

            $shop->destroy($shop->id);

            DB::commit();

            return redirect()->route('shops.index')->with('alert-success', 'Xóa công ty thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa công ty thất bại!');
        }
    }
}

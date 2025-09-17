<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountCodeRequest;
use App\Http\Requests\UpdateDiscountCodeRequest;
use App\Models\DiscountCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = DiscountCode::when($request->search, function ($query, $search) {
            return $query->where('code', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
        ];

        return view('admin.discount-code.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount-code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountCodeRequest $request)
    {
        DB::beginTransaction();
        try {
            $params = $this->handleData($request, 'create');
            DiscountCode::create($params);

            DB::commit();

            return redirect()->route('discount-codes.index')->with('alert-success', 'Thêm mã giảm giá thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Thêm mã giảm giá thất bại!');
        }
    }

    private function createCode()
    {
        do {
            $code = Str::random(10);
        } while (DiscountCode::where('code', $code)->exists());

        return $code;
    }

    private function handleData($request, $type = null)
    {
        $params = $request->all();
        $params['valid_from'] = formatDate($request->valid_from);
        $params['valid_until'] = formatDate($request->valid_until);

        if ($type === 'create') {
            $params['code'] = $this->createCode();
        }

        return $params;
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountCode $discountCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountCode $discountCode)
    {
        $data = [
            'data_edit' => $discountCode,
        ];

        return view('admin.discount-code.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountCodeRequest $request, DiscountCode $discountCode)
    {
        DB::beginTransaction();
        try {
            $params = $this->handleData($request);
            $discountCode->update($params);

            DB::commit();

            return redirect()->route('discount-codes.index')->with('alert-success', 'Cập nhật mã giảm giá thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Cập nhật mã giảm giá thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiscountCode $discountCode)
    {
        try {
            DB::beginTransaction();

            $discountCode->destroy($discountCode->id);

            DB::commit();

            return redirect()->route('discount-codes.index')->with('alert-success', 'Xóa mã giảm giá thành công!');
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return redirect()->back()->with('alert-error', 'Xóa mã giảm giá thất bại!');
        }
    }
}

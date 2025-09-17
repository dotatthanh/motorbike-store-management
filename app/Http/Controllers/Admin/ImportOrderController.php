<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImportOrderRequest;
use App\Models\ImportOrder;
use App\Models\ImportOrderDetail;
use App\Models\ProductVariant;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImportOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = ImportOrder::when($request->search, function ($query, $search) {
            return $query->where('code', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
            'request' => $request,
        ];

        return view('admin.import-order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();

        $data = [
            'suppliers' => $suppliers,
        ];

        return view('admin.import-order.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImportOrderRequest $request)
    {
        DB::beginTransaction();
        try {
            // tạo đơn nhập hàng
            $importOrder = ImportOrder::create([
                'user_id' => Auth::id(),
                'supplier_id' => $request->supplier_id,
            ]);

            $importOrder->update([
                'code' => 'PNH'.str_pad($importOrder->id, 6, '0', STR_PAD_LEFT),
            ]);

            $total_money = 0;
            // tạo chi tiết đơn nhập hàng
            foreach ($request->import_orders as $item) {
                $importOrderDetail = ImportOrderDetail::create([
                    'import_order_id' => $importOrder->id,
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $variant = $importOrderDetail->productVariant;
                $productVariant = ProductVariant::where([
                    'product_id' => $variant->product_id,
                    'variant_id' => $variant->variant_id,
                ])->first();

                $productVariant->update([
                    'quantity' => $productVariant->quantity + $item['quantity'],
                ]);

                $total_money += $item['quantity'] * $item['price'];
            }

            $importOrder->update([
                'total_money' => $total_money,
            ]);

            DB::commit();

            return redirect()->route('import-orders.index')->with('alert-success', 'Tạo đơn nhập hàng thành công!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('alert-error', 'Tạo đơn nhập hàng thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ImportOrder $importOrder)
    {
        $data = $importOrder->importOrderDetails()->with('productVariant.product')
            ->when($request->search, function ($query, $search) {
                $query->whereHas('productVariant.product', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%'.$search.'%');
                });
            })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
            'importOrder' => $importOrder,
        ];

        return view('admin.import-order.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImportOrder $importOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImportOrder $importOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImportOrder $importOrder)
    {
        //
    }
}

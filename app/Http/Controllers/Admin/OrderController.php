<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Order::when($request->search, function ($query, $search) {
            return $query->where('code', 'like', '%'.$search.'%');
        })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
            'request' => $request,
        ];

        return view('admin.order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Order $order)
    {
        $data = $order->orderDetails()->with('productVariant.product')
            ->when($request->search, function ($query, $search) {
                $query->whereHas('productVariant.product', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%'.$search.'%');
                });
            })->paginate(10)->appends(['search' => $request->search]);

        $data = [
            'data' => $data,
            'order' => $order,
        ];

        return view('admin.order.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function updateStatusOrder(Request $request, Order $order)
    {
        if ($order->canBeCanceled()) {
            $order->update(['status' => $request->status]);

            return redirect()->back()->with('alert-success', 'Duyệt đơn đặt hàng thành công!');
        }

        return redirect()->back()->with('alert-error', 'Trạng thái đơn hàng không hợp lệ!');
    }

    public function cancelOrder(Order $order)
    {
        DB::beginTransaction();
        try {
            if ($order->canBeCanceled()) {
                $order->update(['status' => OrderStatus::CANCELED]);

                foreach ($order->orderDetails as $orderDetail) {
                    $productVariant = $orderDetail->productVariant;
                    $productVariant->update([
                        'quantity' => $productVariant->quantity + $orderDetail->quantity,
                    ]);
                }
                DB::commit();

                return redirect()->back()->with('alert-success', 'Hùy đơn thành công!');
            }

            DB::rollBack();

            return redirect()->back()->with('alert-error', 'Trạng thái đơn hàng hiện tại không được hủy đơn. Hủy đơn thất bại!');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('alert-error', 'Hủy đơn thất bại!');
        }
    }
}

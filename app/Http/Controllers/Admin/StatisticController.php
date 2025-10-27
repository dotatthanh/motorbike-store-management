<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopInventory;
use Carbon\Carbon;

class StatisticController extends Controller
{
    public function index(Request $request, Shop $shop)
    {
        $startDate = $request->input('start_date')
            ? Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->startOfDay()
            : null;
        $enđDate = $request->input('end_date')
            ? Carbon::createFromFormat('d-m-Y', $request->input('end_date'))->endOfDay()
            : null;

        $data = ShopInventory::where('shop_id', $shop->id)
            ->with([
                'motorcycle',
                'purchaseOrderItems' => function ($q) use ($shop, $startDate, $enđDate) {
                    $q->whereHas('purchaseOrder', function ($p) use ($shop, $startDate, $enđDate) {
                        $p->where('shop_id', $shop->id);

                        if ($startDate) {
                            $p->whereDate('date', '>=', $startDate);
                        }
                        if ($enđDate) {
                            $p->whereDate('date', '<=', $enđDate);
                        }
                    });
                },
                'salesOrderItems' => function ($q) use ($shop, $startDate, $enđDate) {
                    $q->whereHas('salesOrder', function ($s) use ($shop, $startDate, $enđDate) {
                        $s->where('shop_id', $shop->id);

                        if ($startDate) {
                            $s->whereDate('date', '>=', $startDate);
                        }
                        if ($enđDate) {
                            $s->whereDate('date', '<=', $enđDate);
                        }
                    });
                },
            ])
            ->paginate(10)
            ->appends($request->query());

        $data = [
            'data' => $data,
        ];

        return view('admin.statistic.index', $data);
    }
}

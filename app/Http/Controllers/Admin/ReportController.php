<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Revenue::with(['product', 'productVariant.variant'])
            ->select('product_id', 'product_variant_id', DB::raw('SUM(total_revenue) as total_revenue'))
            ->when($request->from_date, function ($query) use ($request) {
                return $query->whereDate('date', '>=', $request->from_date);
            })
            ->when($request->to_date, function ($query) use ($request) {
                return $query->whereDate('date', '<=', $request->to_date);
            });

        $totalRevenue = $query->sum('total_revenue');
        $data = $query->groupBy('product_id', 'product_variant_id')->paginate(10)->appends([
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
        ]);

        $data = [
            'data' => $data,
            'totalRevenue' => $totalRevenue,
        ];

        return view('admin.report.index', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Shop;

class MapController extends Controller
{
    public function map()
    {
        $shops = Shop::with('company')->get()->map(function ($shop) {
            return [
                'name' => $shop->name,
                'lat' => $shop->latitude,
                'lng' => $shop->longitude,
                'address' => $shop->address,
                'company_name' => $shop->company->name,
                'email' => $shop->email,
                'phone_number' => $shop->phone_number,
                'icon' => 'shop.png',
            ];
        });
        $companies = Company::all()->map(function ($company) {
            return [
                'name' => $company->name,
                'lat' => $company->latitude,
                'lng' => $company->longitude,
                'address' => $company->address,
                'email' => $company->email,
                'phone_number' => $company->phone_number,
                'icon' => 'company.png',
            ];
        });

        $data = $companies->concat($shops);
        $data = [
            'data' => $data,
        ];

        return view('admin.map.index', $data);
    }
}

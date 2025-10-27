<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Motorcycle;
use App\Models\Shop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* companies */
        $companies = [
            [
                'name' => 'Công ty TNHH Xe Máy Sài Gòn',
                'email' => 'contact@xemaysaigon.vn',
                'phone_number' => '02812345678',
                'address' => '45 Lê Lai, Quận 1, TP. Hồ Chí Minh',
                'latitude' => 10.7765,
                'longitude' => 106.7002,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Công ty TNHH Phát Triển Xe Máy Miền Nam',
                'email' => 'info@xemaymiennam.vn',
                'phone_number' => '02898765432',
                'address' => '120 Nguyễn Thị Minh Khai, Quận 3, TP. Hồ Chí Minh',
                'latitude' => 10.7783,
                'longitude' => 106.6999,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($companies as $company) {
            DB::table('companies')->updateOrInsert(
                ['email' => $company['email']],
                $company
            );
        }

        /* 1. Shops */
        $shops = [
            [
                'company_id' => Company::inRandomOrder()->first()->id,
                'name' => 'Cửa hàng Xe Máy Sài Gòn - Chi nhánh Bùi Viện',
                'email' => 'buivien@xemaysaigon.vn',
                'phone_number' => '02811223344',
                'address' => '105 Bùi Viện, Quận 1, TP. Hồ Chí Minh',
                'latitude' => 10.7738,
                'longitude' => 106.6985,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => Company::inRandomOrder()->first()->id,
                'name' => 'Cửa hàng Xe Máy Miền Nam - Chi nhánh CMT8',
                'email' => 'cmt8@xemaymiennam.vn',
                'phone_number' => '02855667788',
                'address' => '256 Cách Mạng Tháng 8, Quận 10, TP. Hồ Chí Minh',
                'latitude' => 10.7805,
                'longitude' => 106.6990,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($shops as $shop) {
            DB::table('shops')->updateOrInsert(
                ['email' => $shop['email']],
                $shop
            );
        }


        $faker = Factory::create('vi_VN');
        $now = Carbon::now();

        /* 2. Motorcycles */
        $motorcycles = [
            'Honda Vision 2024',
            'Yamaha Exciter 155',
            'Honda SH Mode',
            'Yamaha Grande',
            'Honda Air Blade 160',
        ];
        foreach ($motorcycles as $name) {
            DB::table('motorcycles')->insert([
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        /* 3. Suppliers */
        $suppliers = [
            ['Honda Việt Nam', 'contact@honda.com.vn', '0901234567', 'Vĩnh Phúc'],
            ['Yamaha Việt Nam', 'info@yamaha.com.vn', '0909876543', 'Hà Nội'],
            ['Piaggio Việt Nam', 'contact@piaggio.com.vn', '0903334444', 'Vĩnh Phúc'],
        ];
        foreach ($suppliers as $s) {
            DB::table('suppliers')->insert([
                'name' => $s[0],
                'email' => $s[1],
                'phone_number' => $s[2],
                'address' => $s[3],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        /* 4. Customers */
        for ($i = 1; $i <= 10; $i++) {
            DB::table('customers')->insert([
                'code' => 'CUST' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'email' => $faker->unique()->safeEmail(),
                'name' => $faker->name(),
                'address' => $faker->address(),
                'phone' => '09' . rand(10000000, 99999999),
                'birthday' => $faker->date('Y-m-d', '2005-01-01'),
                'gender' => $faker->randomElement(['Nam', 'Nữ']),
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        /* Hàm random ngày gần nhất */
        $randomDate = function () {
            return Carbon::now()->subDays(rand(0, 9))->setTime(rand(8, 18), 0, 0);
        };

        /* 5. Purchase Orders + Items (2-3 items mỗi đơn) */
        for ($i = 1; $i <= 15; $i++) {
            $purchaseOrder = [
                'code' => 'PN' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'supplier_id' => rand(1, 3),
                'shop_id' => Shop::inRandomOrder()->first()->id,
                'total_money' => 0, // tính sau
                'date' => $randomDate(),
                'created_at' => $now,
                'updated_at' => $now
            ];
            $purchaseOrderId = DB::table('purchase_orders')->insertGetId($purchaseOrder);

            $total = 0;
            foreach (range(1, rand(2, 3)) as $x) {
                $quantity = rand(2, 3);
                $price = rand(25000000, 55000000);
                $total += $quantity * $price;

                DB::table('purchase_order_items')->insert([
                    'purchase_order_id' => $purchaseOrderId,
                    'motorcycle_id' => Motorcycle::inRandomOrder()->first()->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            DB::table('purchase_orders')->where('id', $purchaseOrderId)->update([
                'total_money' => $total,
                'code' => 'PN' . str_pad($purchaseOrderId, 3, '0', STR_PAD_LEFT),
            ]);
        }

        /* 6. Sales Orders + Items (2-3 items mỗi đơn) */
        for ($i = 1; $i <= 15; $i++) {
            $salesOrder = [
                'code' => 'PB' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'customer_id' => rand(1, 10),
                'shop_id' => Shop::inRandomOrder()->first()->id,
                'total_money' => 0, // tính sau
                'date' => $randomDate(),
                'created_at' => $now,
                'updated_at' => $now
            ];
            $salesOrderId = DB::table('sales_orders')->insertGetId($salesOrder);

            $total = 0;
            foreach (range(1, rand(2, 3)) as $x) {
                $quantity = rand(1, 2);
                $price = rand(33000000, 68000000);
                $totalItem = $quantity * $price;
                $total += $totalItem;

                DB::table('sales_order_items')->insert([
                    'sales_order_id' => $salesOrderId,
                    'motorcycle_id' => Motorcycle::inRandomOrder()->first()->id,
                    'price' => $price,
                    'quantity' => $quantity,
                    'total_money' => $totalItem,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
            DB::table('sales_orders')->where('id', $salesOrderId)->update([
                'total_money' => $total,
                'code' => 'PB' . str_pad($salesOrderId, 3, '0', STR_PAD_LEFT),
            ]);
        }

        /* 7. Shop Inventories: update tồn kho theo nhập và bán */
        $motorcyclesCount = 5; // số model xe giả định
        $inventories = [];

        foreach (DB::table('purchase_order_items')->get() as $item) {
            $order = DB::table('purchase_orders')->where('id', $item->purchase_order_id)->first();
            $key = $order->shop_id . '_' . $item->motorcycle_id;

            if (!isset($inventories[$key])) {
                $inventories[$key] = [
                    'shop_id' => $order->shop_id,
                    'motorcycle_id' => $item->motorcycle_id,
                    'quantity' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            $inventories[$key]['quantity'] += $item->quantity;
        }

        foreach (DB::table('sales_order_items')->get() as $item) {
            $order = DB::table('sales_orders')->where('id', $item->sales_order_id)->first();
            $key = $order->shop_id . '_' . $item->motorcycle_id;

            if (!isset($inventories[$key])) {
                $inventories[$key] = [
                    'shop_id' => $order->shop_id,
                    'motorcycle_id' => $item->motorcycle_id,
                    'quantity' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            $inventories[$key]['quantity'] -= $item->quantity;
        }

        /* Đảm bảo tồn kho không âm */
        foreach ($inventories as $key => $data) {
            if ($data['quantity'] < 0) {
                $inventories[$key]['quantity'] = 0;
            }
        }

        DB::table('shop_inventories')->insert(array_values($inventories));
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thêm vai trò
        $super_admin = Role::create(['name' => 'Admin', 'guard_name' => 'admin']);

        // Gán vai trò
        User::find(1)->assignRole('Admin');

        $view_user = Permission::create(['name' => 'Xem danh sách nhân viên']);
        $detail_user = Permission::create(['name' => 'Xem thông tin nhân viên']);
        $create_user = Permission::create(['name' => 'Thêm nhân viên']);
        $edit_user = Permission::create(['name' => 'Chỉnh sửa nhân viên']);
        $delete_user = Permission::create(['name' => 'Xóa nhân viên']);

        $super_admin->givePermissionTo($view_user);
        $super_admin->givePermissionTo($detail_user);
        $super_admin->givePermissionTo($create_user);
        $super_admin->givePermissionTo($edit_user);
        $super_admin->givePermissionTo($delete_user);

        $view_role = Permission::create(['name' => 'Xem danh sách vai trò']);
        $create_role = Permission::create(['name' => 'Thêm vai trò']);
        $edit_role = Permission::create(['name' => 'Chỉnh sửa vai trò']);
        $delete_role = Permission::create(['name' => 'Xóa vai trò']);

        $super_admin->givePermissionTo($view_role);
        $super_admin->givePermissionTo($create_role);
        $super_admin->givePermissionTo($edit_role);
        $super_admin->givePermissionTo($delete_role);

        $view_permission = Permission::create(['name' => 'Xem danh sách quyền']);
        $view_permission_detail = Permission::create(['name' => 'Xem quyền']);
        $edit_permission = Permission::create(['name' => 'Chỉnh sửa quyền']);

        $super_admin->givePermissionTo($view_permission);
        $super_admin->givePermissionTo($view_permission_detail);
        $super_admin->givePermissionTo($edit_permission);

        $view_supplier = Permission::create(['name' => 'Xem danh sách nhà cung cấp']);
        $create_supplier = Permission::create(['name' => 'Thêm nhà cung cấp']);
        $edit_supplier = Permission::create(['name' => 'Chỉnh sửa nhà cung cấp']);
        $delete_supplier = Permission::create(['name' => 'Xóa nhà cung cấp']);

        $super_admin->givePermissionTo($view_supplier);
        $super_admin->givePermissionTo($create_supplier);
        $super_admin->givePermissionTo($edit_supplier);
        $super_admin->givePermissionTo($delete_supplier);

        $view_category = Permission::create(['name' => 'Xem danh sách danh mục sản phẩm']);
        $create_category = Permission::create(['name' => 'Thêm danh mục sản phẩm']);
        $edit_category = Permission::create(['name' => 'Chỉnh sửa danh mục sản phẩm']);
        $delete_category = Permission::create(['name' => 'Xóa danh mục sản phẩm']);

        $super_admin->givePermissionTo($view_category);
        $super_admin->givePermissionTo($create_category);
        $super_admin->givePermissionTo($edit_category);
        $super_admin->givePermissionTo($delete_category);

        $view_product = Permission::create(['name' => 'Xem danh sách sản phẩm']);
        $create_product = Permission::create(['name' => 'Thêm sản phẩm']);
        $edit_product = Permission::create(['name' => 'Chỉnh sửa sản phẩm']);
        $delete_product = Permission::create(['name' => 'Xóa sản phẩm']);

        $super_admin->givePermissionTo($view_product);
        $super_admin->givePermissionTo($create_product);
        $super_admin->givePermissionTo($edit_product);
        $super_admin->givePermissionTo($delete_product);

        $view_import_order = Permission::create(['name' => 'Xem danh sách đơn nhập hàng']);
        $create_import_order = Permission::create(['name' => 'Thêm đơn nhập hàng']);
        $detail_import_order = Permission::create(['name' => 'Chi tiết đơn nhập hàng']);

        $super_admin->givePermissionTo($view_import_order);
        $super_admin->givePermissionTo($create_import_order);
        $super_admin->givePermissionTo($detail_import_order);

        $view_order = Permission::create(['name' => 'Xem danh sách đơn hàng']);
        $detail_order = Permission::create(['name' => 'Chi tiết đơn hàng']);
        $update_status_order = Permission::create(['name' => 'Cập nhật trạng thái đơn hàng']);
        $cancel_order = Permission::create(['name' => 'Hủy đơn hàng']);

        $super_admin->givePermissionTo($view_order);
        $super_admin->givePermissionTo($detail_order);
        $super_admin->givePermissionTo($update_status_order);
        $super_admin->givePermissionTo($cancel_order);

        $view_warehouse = Permission::create(['name' => 'Xem danh sách kho hàng']);

        $super_admin->givePermissionTo($view_warehouse);

        $view_discount_code = Permission::create(['name' => 'Xem danh sách mã giảm giá']);
        $create_discount_code = Permission::create(['name' => 'Thêm mã giảm giá']);
        $edit_discount_code = Permission::create(['name' => 'Chỉnh sửa mã giảm giá']);
        $delete_discount_code = Permission::create(['name' => 'Xóa mã giảm giá']);

        $super_admin->givePermissionTo($view_discount_code);
        $super_admin->givePermissionTo($create_discount_code);
        $super_admin->givePermissionTo($edit_discount_code);
        $super_admin->givePermissionTo($delete_discount_code);

        $view_revenue = Permission::create(['name' => 'Xem danh sách doanh thu']);

        $super_admin->givePermissionTo($view_revenue);
    }
}

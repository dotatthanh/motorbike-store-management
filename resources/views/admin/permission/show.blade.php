@extends('layouts.master')

@section('title')
    Xem quyền
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Quyền
        @endslot
        @slot('title')
            Xem quyền
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách quyền</h4>
                    <p class="card-title-desc">Chọn quyền cho vai trò</p>

                    <div class="row">
                        <div class="col-sm-6 col-md-4 mb-3">
                            @foreach ($permissions as $permission)
                                @if ($loop->iteration == 1)
                                    <div class="border p-2 h-100">
                                        <h5 class="mb-3 border-bottom pb-1">Quản lý tài khoản</h5>
                                @endif

                                <div class="d-flex gap-2">
                                    <input name="permissions[{{ $permission->id }}]" type="checkbox"
                                        id="customCheckcolor{{ $permission->id }}"
                                        {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                    <label class="mb-0"
                                        for="customCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>

                                @if ($loop->iteration == 5)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý vai trò</h5>
                            @endif

                            @if ($loop->iteration == 9)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý quyền</h5>
                            @endif

                            @if ($loop->iteration == 12)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý nhà cung cấp</h5>
                            @endif

                            @if ($loop->iteration == 16)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý danh mục sản phẩm</h5>
                            @endif

                            @if ($loop->iteration == 20)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý sản phẩm</h5>
                            @endif

                            @if ($loop->iteration == 24)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý đơn nhập hàng</h5>
                            @endif

                            @if ($loop->iteration == 27)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý đơn hàng</h5>
                            @endif

                            @if ($loop->iteration == 31)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý kho hàng</h5>
                            @endif

                            @if ($loop->iteration == 32)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Quản lý mã giảm giá</h5>
                            @endif

                            @if ($loop->iteration == 36)
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="border p-2 h-100">
                            <h5 class="mb-3 border-bottom pb-1">Thống kê doanh thu</h5>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

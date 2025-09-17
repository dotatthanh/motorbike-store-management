@extends('layouts.master')

@section('title')
    Danh sách đơn nhập hàng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Đơn nhập hàng
        @endslot
        @slot('title')
            Danh sách đơn nhập hàng
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách đơn nhập hàng</h4>
                    </div>
                </div>
                
                <div class="card-body border-bottom">
                    <div class="align-items-center justify-content-between">
                        <div>
                            Mã đơn nhập hàng: {{ $importOrder->code }}
                        </div>
                        <div>
                            Tên người nhập: {{ $importOrder->user->name }}
                        </div>
                        <div>
                            Tên nhà cung cấp: {{ $importOrder->supplier->name }}
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('import-orders.show', $importOrder->id) }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" name="search" class="form-control" id="search" placeholder="Nhập tên sản phẩm" value="{{ request()->search }}">
                        </div>
                        <div class="col-xxl-2 col-lg-4">
                            <button type="submit" class="btn btn-primary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </form>

                
                <div class="card-body table-responsive">
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Size - Màu</th>
                                <th>Số lượng</th>
                                <th>Giá (VNĐ)</th>
                                <th>Thành tiền (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td>{{ $item->productVariant->product->name }}</td>
                                <td>{{ $item->productVariant->variant->size }} - {{ $item->productVariant->variant->color_name }}</td>
                                <td class="text-center">{{ number_format($item->quantity) }}</td>
                                <td class="text-center">{{ number_format($item->price) }}</td>
                                <td class="text-center">{{ number_format($item->quantity * $item->price) }}</td>
                            </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td colspan="5" class="text-end">Tổng tiền</td>
                                <td class="fw-bold text-center">{{ number_format($importOrder->total_money) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy đơn nhập hàng</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Đơn hàng
        @endslot
        @slot('title')
            Danh sách đơn hàng
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách đơn hàng</h4>
                    </div>
                </div>
                
                <div class="card-body border-bottom">
                    <div class="align-items-center justify-content-between">
                        <div>
                            Mã đơn hàng: {{ $order->code }}
                        </div>
                        <div>
                            Tên khách hàng: {{ $order->customer->name }}
                        </div>
                        <div>
                            Phương thức thanh toán: {{ $order->payment_method }}
                        </div>
                        <div>
                            Trạng thái: {{ $order->status }}
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('import-orders.show', $order->id) }}" class="card-body border-bottom">
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
                                <th>Giảm giá (VNĐ)</th>
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
                                <td class="text-center">{{ number_format($item->sale) }}</td>
                                <td class="text-center">{{ number_format($item->total_money) }}</td>
                            </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td colspan="5" class="text-end">Tổng tiền</td>
                                <td class="fw-bold text-center">{{ number_format($order->total_money) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy đơn hàng</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection

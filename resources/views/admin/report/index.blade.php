@extends('layouts.master')

@section('title')
    Thống kê doanh thu
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Thống kê
        @endslot
        @slot('title')
            Doanh thu
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách sản phẩm</h4>
                    </div>
                </div>

                <form method="GET" action="{{ route('reports.index') }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-sm-4">
                            <input type="date" name="from_date" class="form-control" value="{{ request()->from_date }}">
                        </div>
                        <div class="col-xxl-4 col-sm-4">
                            <input type="date" name="to_date" class="form-control" value="{{ request()->to_date }}">
                        </div>
                        <div class="col-xxl-2 col-sm-3">
                            <button type="submit" class="btn btn-primary w-100"><i class="mdi mdi-filter-outline align-middle"></i> Tìm kiếm</button>
                        </div>
                    </div>
                </form>

                <div class="card-body table-responsive">
                    <div class="text-end">Tổng doanh thu: {{ number_format($totalRevenue) }} đ</div>
                    <table class="table table-centered table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 70px;" class="text-center">STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $stt = 1 @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->product->name }} - Size {{ $item->productVariant->variant->size }} - Màu {{ $item->productVariant->variant->color_name }}</td>
                                    <td>{{ number_format($item->total_revenue) }} đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy sản phẩm</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>

@endsection

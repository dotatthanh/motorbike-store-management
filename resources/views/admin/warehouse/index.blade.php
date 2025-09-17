@extends('layouts.master')

@section('title')
    Kho hàng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Kho hàng
        @endslot
        @slot('title')
            Danh sách sản phẩm
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

                <form method="GET" action="{{ route('warehouses.index') }}" class="card-body border-bottom">
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
                                <th>Biến thể</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $stt = 1 @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>
                                        {{ $item->variant->size }} - {{ $item->variant->color_name }}
                                    </td>
                                    <td>{{ number_format($item->variant->quantity) }}</td>
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

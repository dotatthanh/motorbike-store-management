@extends('layouts.master')

@section('title')
    Thống kê
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Thống kê
        @endslot
        @slot('title')
            Thống kê cửa hàng {{ $data->first()->shop->name }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Thống kê</h4>
                        <div class="flex-shrink-0">
                            <a href="{{ route('shops.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('statistic', $data->first()->shop->id) }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-2 col-lg-6">
                            <div class="input-group" id="datepicker1">
                                <input type="text"
                                       class="form-control"
                                       name="start_date"
                                       id="start_date"
                                       autocomplete="off"
                                       placeholder="Từ ngày"
                                       data-date-container='#datepicker1'
                                       data-date-format="dd-mm-yyyy"
                                       data-date-end-date="0d"
                                       data-provide="datepicker"
                                       value="{{ request('start_date') }}"
                                >
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-lg-6">
                            <div class="input-group" id="datepicker1">
                                <input type="text"
                                       class="form-control"
                                       name="end_date"
                                       id="end_date"
                                       autocomplete="off"
                                       placeholder="Đến ngày"
                                       data-date-container='#datepicker1'
                                       data-date-format="dd-mm-yyyy"
                                       data-provide="datepicker"
                                       value="{{ request('end_date') }}"
                                >
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
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
                                <th>Tên xe</th>
                                <th>Số lượng tồn kho</th>
                                <th>Số lượng đã nhập</th>
                                <th>Số lượng đã bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->motorcycle->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->purchaseOrderItems->sum('quantity') }}</td>
                                    <td>{{ $item->salesOrderItems->sum('quantity') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy cửa hàng</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endsection

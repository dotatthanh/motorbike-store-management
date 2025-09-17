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
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách đơn hàng</h4>
                        @can('Thêm đơn hàng')
                            <div class="flex-shrink-0">
                                <a href="{{ route('import-orders.create') }}" class="btn btn-primary">Thêm đơn hàng</a>
                                <a href="{{ route('import-orders.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>

                <form method="GET" action="{{ route('import-orders.index') }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" name="search" class="form-control" id="search" placeholder="Nhập mã đơn hàng" value="{{ request()->search }}">
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
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Tổng tiền (VNĐ)</th>
                                <th>Giảm giá</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $stt++ }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $item->id) }}" class="text-primary">{{ $item->code }}</a>
                                </td>
                                <td>{{ $item->customer->name }}</td>
                                <td>{{ number_format($item->total_money) }}</td>
                                <td>{{ number_format($item->discount) }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>{{ $item->status }}</td>
                                <td class="text-center">
                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                        @can('Cập nhật trạng thái đơn hàng')
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cập nhật trạng thái đơn hàng">
                                            <form method="post" action="{{ route('orders.update-status-order', $item->id) }}">
                                                @csrf
                                                @method('POST')
                                                <button type="button" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target=".edit-status-modal" class="btn btn-sm bg-info text-info bg-soft btn-edit-status">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </button>

                                                @include('admin.order.edit-status-modal')
                                            </form>
                                        </li>
                                        @endcan
                                        @can('Hủy đơn hàng')
                                        @if ($item->canBeCanceled())
                                        <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Hủy đơn hàng">
                                            <form id="cancel-form-{{ $item->id }}" method="post" action="{{ route('orders.cancel-order', $item->id) }}">
                                                @csrf
                                                @method('POST')
                                                <button type="button" data-id="{{ $item->id }}" class="btn btn-sm bg-danger text-danger bg-soft btn-cancel">
                                                    <i class="mdi mdi-delete-outline"></i>
                                                </button>
                                            </form>
                                        </li>
                                        @endif
                                        @endcan
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
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

    @include('components.confirm-modal', ['title' => 'Xác nhận hủy đơn hàng', 'btnName' => 'Hủy'])
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-cancel').on('click', function() {
                const id = $(this).data('id');
                $('#confirmModal').modal('show');
                $('#confirmButton').on('click', function() {
                    $(`#cancel-form-${id}`).submit();
                });
            });
        });
    </script>
@endsection

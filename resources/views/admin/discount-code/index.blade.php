@extends('layouts.master')

@section('title')
    Danh sách mã giảm giá
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Mã giảm giá
        @endslot
        @slot('title')
            Danh sách mã giảm giá
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách mã giảm giá</h4>
                        @can('Thêm mã giảm giá')
                            <div class="flex-shrink-0">
                                <a href="{{ route('discount-codes.create') }}" class="btn btn-primary">Thêm mã giảm giá</a>
                                <a href="{{ route('discount-codes.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>

                <form method="GET" action="{{ route('discount-codes.index') }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" name="search" class="form-control" id="search" placeholder="Nhập họ và tên" value="{{ request()->search }}">
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
                                <th>Mã</th>
                                <th>Số tiền giảm giá</th>
                                <th>Ngày bắt đầu hiệu lực</th>
                                <th>Ngày kết thúc hiệu lực</th>
                                <th>Giới hạn số lần sử dụng</th>
                                <th>Số lần đã sử dụng</th>
                                <th>Trạng thái hoạt động của mã</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->discount_amount }}</td>
                                    <td>{{ formatDate($item->valid_from, 'd-m-Y') }}</td>
                                    <td>{{ formatDate($item->valid_until, 'd-m-Y') }}</td>
                                    <td>{{ $item->usage_limit }}</td>
                                    <td>{{ $item->usage_count }}</td>
                                    <td>{{ getConst('isShow')[$item->active] }}</td>
                                    <td class="text-center">
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('Chỉnh sửa mã giảm giá')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa mã giảm giá">
                                                <a href="{{ route('discount-codes.edit', $item->id) }}" class="btn btn-sm bg-info text-info bg-soft">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('Xóa mã giảm giá')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa mã giảm giá">
                                                <form id="delete-form-{{ $item->id }}" method="post" action="{{ route('discount-codes.destroy', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-id="{{ $item->id }}" data-bs-toggle="modal" class="btn btn-sm bg-danger text-danger bg-soft btn-delete-user">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy mã giảm giá</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa mã giảm giá'])
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-delete-user').on('click', function() {
                const id = $(this).data('id');
                $('#confirmModal').modal('show');
                $('#confirmButton').on('click', function() {
                    $(`#delete-form-${id}`).submit();
                });
            });
        });
    </script>
@endsection

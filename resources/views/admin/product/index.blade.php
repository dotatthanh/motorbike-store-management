@extends('layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Sản phẩm
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
                        @can('Thêm sản phẩm')
                            <div class="flex-shrink-0">
                                <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
                                <a href="{{ route('products.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>

                <form method="GET" action="{{ route('products.index') }}" class="card-body border-bottom">
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
                                <th width="200px">Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên NCC</th>
                                <th>Giá bán</th>
                                <th>Khuyến mãi</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>
                                        <img src="{{ asset($item->file_path) }}" alt="" class="w-100 rounded">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ number_format($item->price) }}</td>
                                    <td>{{ $item->sale }}%</td>
                                    <td class="text-center">
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('Chỉnh sửa sản phẩm')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa sản phẩm">
                                                <a href="{{ route('products.edit', $item->id) }}" class="btn btn-sm bg-info text-info bg-soft">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('Xóa sản phẩm')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa sản phẩm">
                                                <form id="delete-form-{{ $item->id }}" method="post" action="{{ route('products.destroy', $item->id) }}">
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
                        <div class="text-center">Không tìm thấy sản phẩm</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa sản phẩm'])
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

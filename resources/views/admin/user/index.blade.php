@extends('layouts.master')

@section('title')
    Danh sách nhân viên
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhân viên
        @endslot
        @slot('title')
            Danh sách nhân viên
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách nhân viên</h4>
                        @can('Thêm nhân viên')
                            <div class="flex-shrink-0">
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm nhân viên</a>
                                <a href="{{ route('users.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>

                <form method="GET" action="{{ route('users.index') }}" class="card-body border-bottom">
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
                                <th>Ảnh đại diện</th>
                                <th>Họ và tên</th>
                                <th>Vai trò</th>
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Ngày sinh</th>
                                <th>Địa chỉ</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>
                                        @if ($item->avatar)
                                            <div>
                                                <img class="rounded-circle avatar-xs" src="{{ asset($item->avatar) }}" alt="">
                                            </div>
                                        @else
                                            <div class="avatar-xs">
                                                <span class="avatar-title rounded-circle text-uppercase">
                                                    {{ substr($item->name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach ($item->roles as $role)
                                            <span class="badge bg-secondary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $item->gender }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ date("d-m-Y", strtotime($item->birthday)) }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="text-center">
                                        @if ($item->id != 1)
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            @can('Xem thông tin nhân viên')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xem thông tin nhân viên">
                                                <a href="{{ route('users.show', ['user' => $item->id]) }}" class="btn btn-sm bg-primary text-primary bg-soft">
                                                    <i class="mdi mdi-eye-outline"></i>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('Chỉnh sửa nhân viên')
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Chỉnh sửa nhân viên">
                                                <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm bg-info text-info bg-soft">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('Xóa nhân viên')
                                            @if (auth()->guard('admin')->id() != $item->id)
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Xóa nhân viên">
                                                <form id="delete-form-{{ $item->id }}" method="post" action="{{ route('users.destroy', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" data-id="{{ $item->id }}" data-bs-toggle="modal" class="btn btn-sm bg-danger text-danger bg-soft btn-delete-user">
                                                        <i class="mdi mdi-delete-outline"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            @endcan
                                        </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy nhân viên</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa nhân viên'])
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

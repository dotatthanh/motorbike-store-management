@extends('layouts.master')

@section('title')
    Danh sách vai trò
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Vai trò
        @endslot
        @slot('title')
            Danh sách vai trò
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách vai trò</h4>
                        @can('Thêm vai trò')
                            <div class="flex-shrink-0">
                                <a href="{{ route('roles.create') }}" class="btn btn-primary">Thêm vai trò</a>
                                <a href="{{ route('roles.index') }}" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
                        @endcan
                    </div>
                </div>

                <form method="GET" action="{{ route('roles.index') }}" class="card-body border-bottom">
                    <div class="row g-3">
                        <div class="col-xxl-4 col-lg-6">
                            <input type="search" name="search" class="form-control" id="search" placeholder="Nhập tên vai trò" value="{{ request()->search }}">
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
                                <th>Tên vai trò</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php ($stt = 1)
                            @foreach ($data as $role)
                                <tr>
                                    <td class="text-center">{{ $stt++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="text-center">
                                        @if ($role->id > 1)
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                @can('Chỉnh sửa vai trò')
                                                <li class="list-inline-item px">
                                                    <a href="{{ route('roles.edit', $role->id) }}" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="mdi mdi-pencil text-success"></i></a>
                                                </li>
                                                @endcan

                                                @can('Xóa vai trò')
                                                <li class="list-inline-item px">
                                                    <form method="post" action="{{ route('roles.destroy', $role->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Xóa" class="border-0 bg-white"><i class="mdi mdi-trash-can text-danger"></i></button>
                                                    </form>
                                                </li>
                                                @endcan
                                            </ul>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($data->isEmpty())
                        <div class="text-center">Không tìm thấy vai trò</div>
                    @endif
                </div>

                {{ $data->links() }}
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa vai trò'])
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

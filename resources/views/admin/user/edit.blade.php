@extends('layouts.master')

@section('title')
    Cập nhật nhân viên
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhân viên
        @endslot
        @slot('title')
            Cập nhật nhân viên
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật nhân viên</h4>

                    <form method="POST" action="{{ route('users.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.user._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

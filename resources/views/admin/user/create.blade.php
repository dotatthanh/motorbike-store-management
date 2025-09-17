@extends('layouts.master')

@section('title')
    Thêm nhân viên
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhân viên
        @endslot
        @slot('title')
            Thêm nhân viên
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm nhân viên</h4>

                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">

                        @include('admin.user._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('title')
    Cập nhật cửa hàng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Cửa hàng
        @endslot
        @slot('title')
            Cập nhật cửa hàng
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật cửa hàng</h4>

                    <form method="POST" action="{{ route('shops.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.shop._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

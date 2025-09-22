@extends('layouts.master')

@section('title')
    Thêm cửa hàng
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Cửa hàng
        @endslot
        @slot('title')
            Thêm cửa hàng
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm cửa hàng</h4>

                    <form method="POST" action="{{ route('shops.store') }}" enctype="multipart/form-data">

                        @include('admin.shop._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

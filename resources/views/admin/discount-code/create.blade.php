@extends('layouts.master')

@section('title')
    Thêm mã giảm giá
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Mã giảm giá
        @endslot
        @slot('title')
            Thêm mã giảm giá
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm mã giảm giá</h4>

                    <form method="POST" action="{{ route('discount-codes.store') }}" enctype="multipart/form-data">

                        @include('admin.discount-code._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

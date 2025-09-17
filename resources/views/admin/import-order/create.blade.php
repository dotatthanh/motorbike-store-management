@extends('layouts.master')

@section('title')
    Thêm đơn nhập hàng
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Đơn nhập hàng @endslot
        @slot('title') Thêm đơn nhập hàng @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('import-orders.store') }}" enctype="multipart/form-data">

                @include('admin.import-order._form', ['routeType' => 'create'])

            </form>
        </div>
    </div>
    <!-- end row -->

@endsection

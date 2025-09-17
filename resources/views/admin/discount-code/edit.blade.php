@extends('layouts.master')

@section('title')
    Cập nhật mã giảm giá
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Mã giảm giá
        @endslot
        @slot('title')
            Cập nhật mã giảm giá
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật mã giảm giá</h4>

                    <form method="POST" action="{{ route('discount-codes.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.discount-code._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

@extends('layouts.master')

@section('title')
    Thêm danh mục sản phẩm
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Danh mục sản phẩm
        @endslot
        @slot('title')
            Thêm danh mục sản phẩm
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm danh mục sản phẩm</h4>

                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">

                        @include('admin.category._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

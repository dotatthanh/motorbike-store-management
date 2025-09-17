@extends('layouts.master')

@section('title')
    Thêm nhà cung cấp
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhà cung cấp
        @endslot
        @slot('title')
            Thêm nhà cung cấp
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm nhà cung cấp</h4>

                    <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">

                        @include('admin.supplier._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

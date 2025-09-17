@extends('layouts.master')

@section('title')
    Cập nhật nhà cung cấp
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Nhà cung cấp
        @endslot
        @slot('title')
            Cập nhật nhà cung cấp
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật nhà cung cấp</h4>

                    <form method="POST" action="{{ route('suppliers.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.supplier._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

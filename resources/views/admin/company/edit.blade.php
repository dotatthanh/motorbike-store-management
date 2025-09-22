@extends('layouts.master')

@section('title')
    Cập nhật công ty
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Công ty
        @endslot
        @slot('title')
            Cập nhật công ty
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật công ty</h4>

                    <form method="POST" action="{{ route('companies.update', $data_edit->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.company._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

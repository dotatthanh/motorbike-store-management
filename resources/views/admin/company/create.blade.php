@extends('layouts.master')

@section('title')
    Thêm công ty
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Công ty
        @endslot
        @slot('title')
            Thêm công ty
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Thêm công ty</h4>

                    <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">

                        @include('admin.company._form', ['routeType' => 'create'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

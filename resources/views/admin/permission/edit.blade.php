@extends('layouts.master')

@section('title')
    Cập nhật vai trò
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Vai trò
        @endslot
        @slot('title')
            Cập nhật vai trò
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cập nhật vai trò</h4>

                    <form method="POST" action="{{ route('permissions.update', $role->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.permission._form', ['routeType' => 'edit'])

                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection

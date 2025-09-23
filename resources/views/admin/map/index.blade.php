@extends('layouts.master')

@section('title')
    Bản đồ
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Cửa hàng
        @endslot
        @slot('title')
            Danh sách cửa hàng
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách cửa hàng</h4>
                    </div>
                </div>

                <div class="container-map">
                    <div class="place-info">
                        <button type="button" class="btn-close-place-info">x</button>
                        <div class="fw-bold place-info-name"></div>
                        <div class="d-block place-info-company-name"></div>
                        <div class="d-block place-info-email"></div>
                        <div class="d-block place-info-address"></div>
                        <div class="d-block place-info-phone-number"></div>
                    </div>
                    <div id="map" class="w-100" style="height:500px;"></div>
                </div>
            </div>
        </div>
    </div>

    @include('components.confirm-modal', ['title' => 'Xác nhận xóa cửa hàng'])
@endsection

@section('script')
    <!-- map4d -->
    <script>
        var map4dKey = "{{ config('app.map4d_key') }}";
        var data = @json($data);
    </script>
    <script src="{{ asset('/assets/js/admin/route-stop-point.js') }}"></script>
    <script src="https://api.map4d.vn/sdk/map/js?version=2.6&key={{ config('app.map4d_key') }}&callback=initMap"></script>
@endsection
    @section('css')
    <link href="{{ asset('assets/css/pages/route-stop-point.css') }}" rel="stylesheet" type="text/css">
@endsection


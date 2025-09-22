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
                    {{-- <div class="box-search">
                        <div class="box-search-content">
                            <input type="text" placeholder="Tìm kiếm Map4D" id="input-search-map">
                            <button type="button">
                                <img src="{{ asset('assets/images/icon-search.svg') }}" alt="">
                            </button>
            
                        </div>
                        <div class="list-search"></div>
                    </div> --}}
                    {{-- <div class="place-info">
                        <button type="button" class="btn-close-place-info">x</button>
                        <div class="fw-bold place-info-name"></div>
                        <div class="d-block place-info-address"></div>
                        <div class="d-block place-info-latlng"></div>
                    </div>
                    <div id="map" class="w-100" style="height:500px;"></div> --}}

                    <div id="map" style="width:100%;height:500px"></div>
                    {{-- <div id="store-popup" class="place-info"></div> --}}
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
    </script>
    <script src="{{ asset('/assets/js/admin/route-stop-point.js') }}"></script>
    <script src="https://api.map4d.vn/sdk/map/js?version=2.6&key={{ config('app.map4d_key') }}&callback=initMap"></script>
@endsection
    @section('css')
    <!-- datepicker css -->
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/pages/route-stop-point.css') }}" rel="stylesheet" type="text/css">
    <style>
        .mf-info-window-content h4,
        .mf-info-window-content p {
            font-family: inherit !important;
        }
    </style>

@endsection


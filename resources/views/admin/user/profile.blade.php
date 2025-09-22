@extends('layouts.master')

@section('title')
    Thông tin cá nhân
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Thông tin cá nhân</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Thông tin cá nhân</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Thông tin cá nhân</h4>

                <div class="table-responsive">
                    <table class="table table-nowrap mb-0">
                        <tbody>
                            <tr>
                                <td scope="row">Họ và tên :</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Gới tính :</td>
                                <td>{{ $user->gender }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Số điện thoại :</td>
                                <td>{{ $user->phone_number }}</td>
                            </tr>
                            <tr>
                                <td scope="row">E-mail :</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Ngày sinh :</td>
                                <td>{{ date("d-m-Y", strtotime($user->birthday)) }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Địa chỉ :</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <td scope="row"></td>
                                <td>
                                    <a href="{{ route('users.change-password', $user->id) }}" class="btn bg-danger text-danger bg-soft">
                                        Đổi mật khẩu
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

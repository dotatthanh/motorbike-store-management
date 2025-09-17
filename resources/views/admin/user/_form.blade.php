@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Họ và tên <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Họ và tên" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="gender">Giới tính <span class="text-danger">*</span></label>
            <div class="form-check form-check">
                <input type="radio" class="form-check-input" id="nam" name="gender" value="Nam" {{ isset($data_edit->gender) && $data_edit->gender == 'Nam' ? 'checked' : '' }} checked>
                <label class="form-check-label" for="nam">Nam</label>
            </div>
            <div class="form-check form-check">
                <input type="radio" class="form-check-input" id="nu" name="gender" value="Nữ" {{ isset($data_edit->gender) && $data_edit->gender == 'Nữ' ? 'checked' : '' }}>
                <label class="form-check-label" for="nu">Nữ</label>
            </div>
            {!! $errors->first('gender', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="dob">Ngày sinh <span class="text-danger">*</span></label>
            <div class="input-group" id="datepicker1">
                <input type="text"
                    class="form-control"
                    name="birthday"
                    id="dob"
                    placeholder="dd-mm-yyyy"
                    data-date-container='#datepicker1'
                    data-date-format="dd-mm-yyyy"
                    data-date-end-date="0d"
                    data-provide="datepicker"
                    value="{{ old('birthday', isset($data_edit->birthday) ? date('d-m-Y', strtotime($data_edit->birthday)) : '') }}"
                >
                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
            </div>
            <div class="text-danger" id="dobError" data-ajax-feedback="dob"></div>
            {!! $errors->first('birthday', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="role">Vai trò <span class="text-danger">*</span></label>
            <select
                name="roles[]"
                id="addRole"
                class="select2 select2-multiple form-control"
                multiple
                data-placeholder="Chọn vai trò ..."
            >
                @foreach ($roles as $item)
                    <option
                        {{ isset($data_edit) && in_array($item->id, $data_edit->roles->pluck('id')->toArray()) ?
                        'selected' : '' }}
                        value="{{ $item->id }}">
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('roles', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email', $data_edit->email ?? '') }}">
            {!! $errors->first('email', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="avatar">Ảnh đại diện @if($routeType == 'create')<span class="text-danger">*</span>@endif</label>
            <input id="avatar" name="avatar" type="file" class="form-control">
            {!! $errors->first('avatar', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="phone_number">Số điện thoại <span class="text-danger">*</span></label>
            <input id="phone_number" name="phone_number" type="number" class="form-control" placeholder="Số điện thoại" value="{{ old('phone_number', $data_edit->phone_number ?? '') }}">
            {!! $errors->first('phone_number', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="address">Địa chỉ <span class="text-danger">*</span></label>
            <input id="address" name="address" type="text" class="form-control" placeholder="Địa chỉ" value="{{ old('address', $data_edit->address ?? '') }}">
            {!! $errors->first('address', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('users.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>

@section('script')
    <!-- datepicker css -->
    <script src="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- select 2 plugin -->
    <script src="{{ asset('assets\libs\select2\select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('assets\js\pages\ecommerce-select2.init.js') }}"></script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <!-- select2 css -->
    <link href="{{ asset('assets\libs\select2\select2.min.css') }}" rel="stylesheet" type="text/css">
@endsection

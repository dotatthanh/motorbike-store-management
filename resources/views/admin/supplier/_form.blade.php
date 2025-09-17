@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên nhà cung cấp <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên nhà cung cấp" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="phone_number">Số điện thoại <span class="text-danger">*</span></label>
            <input id="phone_number" name="phone_number" type="number" class="form-control" placeholder="Số điện thoại" value="{{ old('phone_number', $data_edit->phone_number ?? '') }}">
            {!! $errors->first('phone_number', '<span class="error d-block mt-2">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{ old('email', $data_edit->email ?? '') }}">
            {!! $errors->first('email', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="address">Địa chỉ <span class="text-danger">*</span></label>
            <input id="address" name="address" type="text" class="form-control" placeholder="Địa chỉ" value="{{ old('address', $data_edit->address ?? '') }}">
            {!! $errors->first('address', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('suppliers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>

@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="discount_amount">Số tiền giảm giá <span class="text-danger">*</span></label>
            <input id="discount_amount" name="discount_amount" type="text" class="form-control" placeholder="Số tiền giảm giá" value="{{ old('discount_amount', $data_edit->discount_amount ?? '') }}">
            {!! $errors->first('discount_amount', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="usage_limit">Giới hạn số lần sử dụng</label>
            <input id="usage_limit" name="usage_limit" type="text" class="form-control" placeholder="Giới hạn số lần sử dụng" value="{{ old('usage_limit', $data_edit->usage_limit ?? '') }}">
            {!! $errors->first('usage_limit', '<span class="error d-block mt-2">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group mb-3">
            <div class="row input-daterange " data-provide="datepicker" data-date-format="dd-mm-yyyy">
                <div class="col-sm-6">
                    <label>Ngày bắt đầu hiệu lực <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Ngày bắt đầu hiệu lực" name="valid_from" value="{{ old('valid_from', isset($data_edit->valid_from) ? date('d-m-Y', strtotime($data_edit->valid_from)) : '') }}" />
                    {!! $errors->first('valid_from', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
                <div class="col-sm-6">
                    <label>Ngày kết thúc hiệu lực <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Ngày kết thúc hiệu lực" name="valid_until" value="{{ old('valid_until', isset($data_edit->valid_until) ? date('d-m-Y', strtotime($data_edit->valid_until)) : '') }}" />
                    {!! $errors->first('valid_until', '<span class="error d-block mt-2">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="active">Hiển thị <span class="text-danger">*</span></label>
            <select name="active" class="form-control" id="active">
                @foreach (getConst('isShow') as $id => $name)
                    <option value="{{ $id }}" {{ old('active', $data_edit->active ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            {!! $errors->first('active', '<span class="error d-block mt-2">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('discount-codes.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>

@section('script')
    <!-- datepicker css -->
    <script src="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endsection

@section('css')
    <!-- datepicker css -->
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

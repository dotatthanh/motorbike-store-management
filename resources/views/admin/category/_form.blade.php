@csrf

<h4 class="card-title">Thông tin cơ bản</h4>
<p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="name">Tên danh mục sản phẩm <span class="text-danger">*</span></label>
            <input id="name" name="name" type="text" class="form-control" placeholder="Tên danh mục sản phẩm" value="{{ old('name', $data_edit->name ?? '') }}">
            {!! $errors->first('name', '<span class="error d-block mt-2">:message</span>') !!}
        </div>

        <div class="form-group mb-3">
            <label for="sort">Sắp xếp</label>
            <input id="sort" name="sort" type="number" class="form-control" placeholder="Sắp xếp" value="{{ old('sort', $data_edit->sort ?? '') }}">
            {!! $errors->first('sort', '<span class="error d-block mt-2">:message</span>') !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="is-show">Hiển thị <span class="text-danger">*</span></label>
            <select name="is_show" class="form-control" id="is-show">
                @foreach (getConst('isShow') as $id => $name)
                    <option value="{{ $id }}" {{ old('is_show', $data_edit->is_show ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            {!! $errors->first('is_show', '<span class="error d-block mt-2">:message</span>') !!}
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
<a href="{{ route('categories.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>

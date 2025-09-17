@csrf

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

        <div class="row">
            <div class="col-sm-6 mb-3">
                <label for="name">Tên sản phẩm <span class="text-danger">*</span></label>
                <input id="name" name="name" type="text" class="form-control" placeholder="Tên sản phẩm" value="{{ old('name', $data_edit->name ?? '') }}">
                {!! $errors->first('name', '<span class="error d-block mt-2">:message</span>') !!}
            </div>

            <div class="col-sm-6 mb-3">
                <label class="control-label">Nhà cung cấp <span class="text-danger">*</span></label>
                <select class="form-control select2" name="supplier_id">
                    <option value="">Chọn nhà cung cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ old('supplier_id', $data_edit->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('supplier_id', '<span class="error d-block mt-2">:message</span>') !!}
            </div>

            <div class="col-sm-6 mb-3">
                <label for="file_path">Ảnh sản phẩm @if ($routeType == 'create') <span class="text-danger">*</span> @endif
                </label>
                <input id="file_path" name="file_path" type="file" class="form-control">
                {!! $errors->first('file_path', '<span class="error d-block mt-2">:message</span>') !!}
            </div>

            <div class="col-sm-6 mb-3">
                <label id="categories" class="control-label">Danh mục <span class="text-danger">*</span></label>
                <select
                    name="categories[]"
                    id="categories"
                    class="select2 select2-multiple form-control"
                    multiple
                    data-placeholder="Chọn danh mục ..."
                >
                    @foreach ($categories as $item)
                        <option
                            {{ in_array($item->id, old('categories', isset($data_edit) ? $data_edit->categories->pluck('id')->toArray() : [])) ? 'selected' : '' }}
                            value="{{ $item->id }}">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->first('categories', '<span class="error d-block mt-2">:message</span>') !!}
            </div>

            <div class="col-sm-6 mb-3">
                <label for="price">Giá bán <span class="text-danger">*</span></label>
                <input id="price" name="price" type="number" class="form-control" placeholder="Giá bán" value="{{ old('price', $data_edit->price ?? '') }}">
                {!! $errors->first('price', '<span class="error d-block mt-2">:message</span>') !!}
            </div>

            <div class="col-sm-6 mb-3">
                <label for="sale">Khuyến mãi</label>
                <div class="input-group">
                    <input id="sale" name="sale" type="number" class="form-control" placeholder="Khuyến mãi" value="{{ old('sale', $data_edit->sale ?? '') }}">
                    <span class="input-group-text">%</span>
                </div>
                {!! $errors->first('sale', '<span class="error d-block mt-2">:message</span>') !!}
            </div>
        </div>

    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Ảnh chi tiết sản phẩm <span class="text-danger">*</span></h4>

        <input type="text" hidden name="product_images">
        <div class="dropzone" id="dropzone">
            <div class="dz-message needsclick">
                <div class="mb-3">
                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                </div>

                <h4>Thả tập tin vào đây hoặc nhấn vào để tải lên.</h4>
            </div>
            @csrf
        </div>
        {!! $errors->first('product_images', '<span class="error d-block mt-2">:message</span>') !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Mô tả</h4>

        <textarea id="elm1" name="description"> {{ old('description', $data_edit->description ?? '') }}</textarea>
        {!! $errors->first('description', '<span class="error d-block mt-2">:message</span>') !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Biến thể <span class="text-danger">*</span></h4>
        <div class="repeater" enctype="multipart/form-data">
            <div data-repeater-list="variants">
                @php
                    $variants = old('variants', isset($data_edit) ? $data_edit->variants : null);
                @endphp
                @if (isset($variants))
                    @foreach ($variants as $variant)
                        <div data-repeater-item class="row">
                            <div class="mb-3 col-lg-3 col-sm-4">
                                <label>Size <span class="text-danger">*</span></label>
                                <input type="text" name="size" class="form-control" placeholder="S, M, L, XL, XXL, XXXL" value="{{ $variant['size'] }}" />
                                {!! $errors->first('variants.*.size', '<span class="error d-block mt-2">:message</span>') !!}
                            </div>

                            <div class="mb-3 col-lg-3 col-sm-4">
                                <label>Tên màu <span class="text-danger">*</span></label>
                                <input type="text" name="color_name" class="form-control" placeholder="Nhập tên màu" value="{{ $variant['color_name'] }}" />
                                {!! $errors->first('variants.*.color_name', '<span class="error d-block mt-2">:message</span>') !!}
                            </div>

                            <div class="mb-3 col-lg-3 col-sm-4">
                                <label>Mã màu <span class="text-danger">*</span></label>
                                <input type="text" name="color_code" class="form-control colorpicker-default" placeholder="Chọn mã màu" value="{{ $variant['color_code'] }}" />
                                {!! $errors->first('variants.*.color_code', '<span class="error d-block mt-2">:message</span>') !!}
                            </div>

                            <div class="col-lg-2 col-sm-2 mb-3">
                                <label>&nbsp;</label>
                                <input data-repeater-delete type="button" class="btn btn-danger d-block" value="Xóa" />
                            </div>
                        </div>
                    @endforeach
                @else
                    <div data-repeater-item class="row">
                        <div class="mb-3 col-lg-3 col-sm-4">
                            <label>Size <span class="text-danger">*</span></label>
                            <input type="text" name="size" class="form-control" placeholder="S, M, L, XL, XXL, XXXL" />
                        </div>

                        <div class="mb-3 col-lg-3 col-sm-4">
                            <label>Tên màu <span class="text-danger">*</span></label>
                            <input type="text" name="color_name" class="form-control" placeholder="Nhập tên màu" />
                        </div>

                        <div class="mb-3 col-lg-3 col-sm-4">
                            <label>Mã màu <span class="text-danger">*</span></label>
                            <input type="text" name="color_code" class="form-control colorpicker-default" placeholder="Chọn mã màu">
                        </div>

                        <div class="col-lg-2 col-sm-2 mb-3">
                            <label>&nbsp;</label>
                            <input data-repeater-delete type="button" class="btn btn-danger d-block" value="Xóa" />
                        </div>
                    </div>
                @endif
            </div>
            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm" />
        </div>
        {!! $errors->first('variants', '<span class="error d-block mt-2">:message</span>') !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>

@csrf

<div class="card">
    <div class="card-body">

        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Vui lòng điền đầy đủ thông tin bên dưới</p>

        <div class="row">
            <div class="col-sm-6">
                <label class="control-label">Nhà cung cấp <span class="text-danger">*</span></label>
                <select class="form-control select2" name="supplier_id" onchange="getProductsBySupplierId($(this).val())">
                    <option value="">Chọn nhà cung cấp</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            {{ old('supplier_id', $data_edit->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}</option>
                    @endforeach
                </select>
                {!! $errors->first('supplier_id', '<span class="error d-block mt-2">:message</span>') !!}
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Chi tiết nhập hàng <span class="text-danger">*</span></h4>
        <div class="repeater" enctype="multipart/form-data">
            <div data-repeater-list="import_orders">
                @php
                    $importOrders = old('import_orders', isset($data_edit) ? $data_edit->import_orders : [['product_id' => null, 'product_variant_id' => null, 'quantity' => null, 'price' => null]]);
                @endphp
                @foreach ($importOrders as $item)
                    <div data-repeater-item class="row">
                        <div class="mb-3 col-xl-3 col-lg-4 col-md-5">
                            <label>Sản phẩm <span class="text-danger">*</span></label>
                            <select class="form-control select2 select-product" name="product_id" onchange="getVariantsByProductId($(this))">
                                <option value="">Chọn sản phẩm</option>
                                {{-- @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $item['product_id'] == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}</option>
                                @endforeach --}}
                            </select>
                            {!! $errors->first('import_orders.*.product_id', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>

                        <div class="mb-3 col-xl-4 col-lg-4 col-md-5">
                            <label>Size và màu <span class="text-danger">*</span></label>
                            <select class="form-control select2 select-product-variant" name="product_variant_id">
                                <option value="">Chọn size và màu</option>
                                @foreach (\App\Models\ProductVariant::where('product_id', $item['product_id'])->get() as $productVariant)
                                    <option value="{{ $productVariant->id }}"
                                        {{ $item['product_variant_id'] == $productVariant->id ? 'selected' : '' }}>
                                        {{ $productVariant->variant->size }} - {{ $productVariant->variant->color_name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('import_orders.*.product_variant_id', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>

                        <div class="mb-3 col-xl-2 col-lg-4 col-md-5 col-sm-6">
                            <label>Số lượng <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" placeholder="Nhập số lượng" value="{{ $item['quantity'] }}">
                            {!! $errors->first('import_orders.*.quantity', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>
                        
                        <div class="mb-3 col-xl-2 col-lg-4 col-md-5 col-sm-6">
                            <label>Giá nhập <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" placeholder="Nhập giá nhập" value="{{ $item['price'] }}">
                            {!! $errors->first('import_orders.*.price', '<span class="error d-block mt-2">:message</span>') !!}
                        </div>

                        <div class="col-xl-1 mb-3 col-2">
                            <label>&nbsp;</label>
                            <input data-repeater-delete type="button" class="btn btn-danger d-block" value="Xóa" />
                        </div>
                    </div>
                @endforeach
            </div>
            <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm" />
        </div>
        {!! $errors->first('import_orders', '<span class="error d-block mt-2">:message</span>') !!}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>

@section('css')
    <!-- select2 css -->
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <!-- select 2 plugin -->
    <script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('/assets/js/pages/ecommerce-select2.init.js') }}"></script>

    <!-- form repeater js -->
    <script src="{{ asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <!-- repeater init js-->
    <script src="{{ asset('/assets/js/pages/import-order/form-repeater.int.js') }}"></script>

    <script type="text/javascript">
        function getVariantsByProductId(self) {
            const index = self.attr('name').match(/import_orders\[(\d+)\]/)[1];
            const id = self.val()
            var select = $(`select[name="import_orders[${index}][product_variant_id]"]`);
            var defaultOption = '<option value="">Chọn size và màu</option>';

            select.html(defaultOption);

            if (!id) return;

            $.ajax({
                url: `/admin/products/get-variants/${id}`,
                type: "POST"
            })
            .done(function (response) {
                if (response.data && response.data.length) {
                    let options = response.data.map(function (item) {
                        return `<option value="${item.id}">${item.variant.size} - ${item.variant.color_name}</option>`;
                    }).join('');

                    select.html(defaultOption + options);
                }
            })
            .fail(function () {
                alert('Lỗi server! Không thể tải danh sách biến thể.');
            });
        }

        function getProductsBySupplierId(id) {
            var selectProducts = $(`.select-product`);
            var selectProductVariants = $(`.select-product-variant`);
            var defaultOptionProduct = '<option value="">Chọn sản phẩm</option>';
            var defaultOptionProductVariants = '<option value="">Chọn size và màu</option>';

            selectProducts.html(defaultOptionProduct);
            selectProductVariants.html(defaultOptionProductVariants);

            if (!id) return;

            $.ajax({
                url: `/admin/products/supplier/${id}`,
                type: "POST"
            })
            .done(function (response) {
                if (response.data && response.data.length) {
                    let options = response.data.map(function (item) {
                        return `<option value="${item.id}">${item.name}</option>`;
                    }).join('');

                    selectProducts.html(defaultOptionProduct + options);
                }
            })
            .fail(function () {
                alert('Lỗi server! Không thể tải danh sách sản phẩm.');
            });
        }
    </script>
@endsection
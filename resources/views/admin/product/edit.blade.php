@extends('layouts.master')

@section('title')
    Cập nhật sản phẩm
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Sản phẩm @endslot
        @slot('title') Cập nhật sản phẩm @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('products.update', $data_edit->id) }}" enctype="multipart/form-data" id="form-product">
                @method('PUT')
                @include('admin.product._form', ['routeType' => 'edit'])
            </form>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('css')
    <!-- select2 css -->
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- dropzone css -->
    <link href="{{ asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- colorpicker css -->
    <link href="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script')
    <!-- select 2 plugin -->
    <script src="{{ asset('/assets/libs/select2/select2.min.js') }}"></script>

    <!-- dropzone plugin -->
    <script src="{{ asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('/assets/js/pages/ecommerce-select2.init.js') }}"></script>

    <!--tinymce js-->
    <script src="{{ asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('/assets/js/pages/form-editor.init.js') }}"></script>

    <!-- form repeater js -->
    <script src="{{ asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>

    <!-- repeater init js-->
    <script src="{{ asset('/assets/js/pages/product/form-repeater.int.js') }}"></script>

    <!-- colorpicker init js-->
    <script src="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".colorpicker-default").spectrum()
        });
        let productImages = $(`input[name="product_images"]`).val();

        Dropzone.options.dropzone =
        {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "{{ route('products.upload-image-details') }}",
            method: "POST",
            paramName: "file",
            acceptedFiles: "image/*",
            uploadMultiple: true,
            addRemoveLinks: true,
            dictRemoveFileConfirmation: "Bạn có chắc chắn muốn xóa file?",
            dictRemoveFile: "Xóa file",
            success: function (file, response) {
                let index = file.upload.uuid;
                response.data.forEach(filePath => {
                    if (filePath.indexOf(file.upload.filename) !== -1) {
                        let input = `<input type="hidden" name="product_images[${index}]" value="${filePath}">`;
                        $('form').append(input);
                    }
                });
                file.index = index;
            },
            error: function (file, response) {
                return false;
            },
            removedfile: function(file) {
                var _ref;
                (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

                $(`input[name="product_images[${file.index}]"]`).remove();
            },
            init: function () {
                var existingImages = @json(old('product_images', $data_edit->productImages->pluck('file_path', 'id')));
                if (existingImages != null) {
                    $.each(existingImages, function(uuid, filePath) {
                        var fileName = filePath.split('/').pop();
                        var mockFile = { name: fileName, index: uuid }; // Size có thể tùy chỉnh nếu cần

                        // Hiển thị ảnh giả trong Dropzone
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, '/' + filePath); // Hiển thị thumbnail từ URL
                        this.emit("complete", mockFile);

                        // Thêm input ẩn chứa thông tin ảnh vào form
                        let input = `<input type="hidden" name="product_images[${uuid}]" value="${filePath}">`;
                        $('#form-product').append(input);

                        // Thêm file vào danh sách file của Dropzone
                        this.files.push(mockFile);
                    }.bind(this));
                }
            },
        };
    </script>
@endsection

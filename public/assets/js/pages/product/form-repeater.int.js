(function () {
    $(document).ready(function () {
        "use strict";

        $(".repeater").repeater({
            defaultValues: {
                "textarea-input": "foo",
                "text-input": "bar",
                "select-input": "B",
                "checkbox-input": ["A", "B"],
                "radio-input": "B"
            },
            show: function show() {
                $(this).slideDown();
                $(".colorpicker-default").spectrum()
            },
            hide: function hide(e) {
                confirm("Bạn có chắc chắn muốn xóa phần tử này không?") && $(this).slideUp(e);
            },
            ready: function ready(e) { }
        })
    });
})();
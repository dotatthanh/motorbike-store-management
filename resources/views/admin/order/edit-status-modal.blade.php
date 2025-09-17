<div class="modal fade edit-status-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Cập nhật trạng thái đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="select-status">Trạng thái</label>
                    <select name="status" class="form-control" id="select-status">
                        <option value="">Chọn trạng thái</option>
                        @foreach (\App\Enums\OrderStatus::getUpdatableStatuses($item->status) as $orderStatusName)
                            <option value="{{ $orderStatusName }}">{{ $orderStatusName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3 d-grid">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
</div>


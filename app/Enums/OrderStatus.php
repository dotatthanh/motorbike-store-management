<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const PENDING = 'Đang xử lý';

    const APPROVED = 'Đã duyệt';

    const SHIPPING = 'Đang vận chuyển';

    const DELIVERED = 'Đã giao';

    const COMPLETED = 'Hoàn thành';

    const CANCELED = 'Đã hủy';

    public static function getCancelableStatuses(): array
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::SHIPPING,
        ];
    }

    // public static function getNonCanceledStatuses(): array
    // {
    //     return array_filter(self::getValues(), function ($status) {
    //         return $status !== self::CANCELED;
    //     });
    // }

    // list Trạng thái có thể cập nhật
    public static function getUpdatableStatuses(string $status): array
    {
        $allStatuses = self::getValues();
        $position = array_search($status, $allStatuses);

        if ($position === false) {
            return []; // Trường hợp status không tồn tại trong danh sách
        }

        // Lấy các status sau status truyền vào
        $statusesAfter = array_slice($allStatuses, $position + 1);

        // Loại bỏ status CANCELED
        return array_filter($statusesAfter, function ($status) {
            return $status !== self::CANCELED;
        });
    }
}

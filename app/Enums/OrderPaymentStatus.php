<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderPaymentStatus extends Enum
{
    const VNPAY = 'Vnpay';

    const CASH_ON_DELIVERY = 'Thanh toán khi nhận hàng';
}

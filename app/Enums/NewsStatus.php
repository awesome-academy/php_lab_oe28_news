<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class NewsStatus extends Enum
{
    const StatusRejected = 0;
    const StatusPublished = 1;
    const StatusApproved = 2;
    const StatusNeedEditMore = 3;
    const StatusNew = 4;
}
